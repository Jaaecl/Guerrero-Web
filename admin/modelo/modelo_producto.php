<?php
include_once 'C:/xampp/htdocs/market/model/conexion.php';

class Producto {
    private $id;
    private $nombre;
    private $categoria;
    private $proveedor;
    private $existencia_inicial;
    private $existencia_actual;
    private $stock_minimo;
    private $precio_venta;
    private $imagen;

    public function __construct($id = null, $nombre = null, $categoria = null, $proveedor = null, $existencia_inicial = null, $existencia_actual = null, $stock_minimo = null, $precio_venta = null, $imagen = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->categoria = $categoria;
        $this->proveedor = $proveedor;
        $this->existencia_inicial = $existencia_inicial;
        $this->existencia_actual = $existencia_actual;
        $this->stock_minimo = $stock_minimo;
        $this->precio_venta = $precio_venta;
        $this->imagen = $imagen;
        $this->con = Conectar::conexion();
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getProveedor() {
        return $this->proveedor;
    }

    public function setProveedor($proveedor) {
        $this->proveedor = $proveedor;
    }

    public function getExistenciaInicial() {
        return $this->existencia_inicial;
    }

    public function setExistenciaInicial($existencia_inicial) {
        $this->existencia_inicial = $existencia_inicial;
    }

    public function getExistenciaActual() {
        return $this->existencia_actual;
    }

    public function setExistenciaActual($existencia_actual) {
        $this->existencia_actual = $existencia_actual;
    }

    public function getStockMinimo() {
        return $this->stock_minimo;
    }

    public function setStockMinimo($stock_minimo) {
        $this->stock_minimo = $stock_minimo;
    }

    public function getPrecioVenta() {
        return $this->precio_venta;
    }

    public function setPrecioVenta($precio_venta) {
        $this->precio_venta = $precio_venta;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function guardar() {
        $con = Conectar::conexion();

        $sql = "INSERT INTO productos (nombre_producto, categoria_producto, proveedor_producto, existencia_inicial_producto, existencia_actual_producto, stock_min_producto, precio_venta_producto, imagen_producto) VALUES (:nombre, :categoria, :proveedor, :existencia_inicial, :existencia_inicial, :stock_minimo, :precio_venta, :imagen)";

        $stmt = $con->prepare($sql);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':proveedor', $this->proveedor);
        $stmt->bindParam(':existencia_inicial', $this->existencia_inicial);
        $stmt->bindParam(':stock_minimo', $this->stock_minimo);
        $stmt->bindParam(':precio_venta', $this->precio_venta);
        $stmt->bindParam(':imagen', $this->imagen);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function actualizar() {
        $con = Conectar::conexion();

        $sql = "UPDATE productos SET nombre_producto = COALESCE(:nombre, nombre_producto), categoria_producto = COALESCE(:categoria, categoria_producto), proveedor_producto = COALESCE(:proveedor, proveedor_producto), stock_min_producto = COALESCE(:stock_minimo, stock_min_producto), precio_venta_producto = COALESCE(:precio_venta, precio_venta_producto), imagen_producto = COALESCE(:imagen, imagen_producto) WHERE Id_producto = :id";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':proveedor', $this->proveedor);
        $stmt->bindParam(':stock_minimo', $this->stock_minimo);
        $stmt->bindParam(':precio_venta', $this->precio_venta);
        $stmt->bindParam(':imagen', $this->imagen);
        $stmt->bindParam(':id', $this->id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al actualizar el producto: " . $e->getMessage();
            return false;
        }
    }

    public function eliminar() {
        $con = Conectar::conexion();

        $sql = "DELETE FROM productos WHERE Id_producto=:id";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $this->id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al eliminar el producto: " . $e->getMessage();
            return false;
        }
    }

    public static function listar() {
        $con = Conectar::conexion();
        $sql=('SELECT * FROM productos
            INNER JOIN categorias ON productos.categoria_producto = categorias.Id_categoria
            INNER JOIN proveedores ON productos.proveedor_producto = proveedores.Id_proveedor
            ORDER BY Id_producto ASC
        ');

        $stmt = $con->prepare($sql);
        $stmt->execute();

        $productos = array();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $producto = new Producto(
                $fila['Id_producto'],
                $fila['nombre_producto'],
                $fila['nombre_categoria'],
                $fila['razon_social_proveedor'],
                $fila['existencia_inicial_producto'],
                $fila['existencia_actual_producto'],
                $fila['stock_min_producto'],
                $fila['precio_venta_producto'],
                $fila['imagen_producto'],
            );
            $productos[] = $producto;
        }
        return $productos;
    }

    public static function pocoStock() {
        $con = Conectar::conexion();
        $sql=('SELECT * FROM productos WHERE existencia_actual_producto <= stock_min_producto');

        $stmt = $con->prepare($sql);
        $stmt->execute();

        $productos = array();
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $producto = new Producto(
                $fila['Id_producto'],
                $fila['nombre_producto'],
                $fila['categoria_producto'],
                $fila['proveedor_producto'],
                $fila['existencia_inicial_producto'],
                $fila['existencia_actual_producto'],
                $fila['stock_min_producto'],
                $fila['precio_venta_producto'],
                $fila['imagen_producto'],
            );
            $productos[] = $producto;
        }
        return $productos;
    }

    public static function filtroCategoria($categoria) {
    $query = "SELECT * FROM productos WHERE categoria_producto = ?";
    $stmt = $this->con->prepare($query);
    $stmt->execute([$categoria]);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
  }

  public static function filtroMarca($marca) {
    $query = "SELECT * FROM productos WHERE proveedor_producto = ?";
    $stmt = $this->con->prepare($query);
    $stmt->execute([$marca]);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $result;
  }

}
?>
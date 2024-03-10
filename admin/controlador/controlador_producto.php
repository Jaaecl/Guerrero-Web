<?php
include_once 'auditorias.php';

include_once 'C:/xampp/htdocs/market/admin/modelo/modelo_producto.php';
$productosController = new ProductosController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $productosController->create();
    } elseif (isset($_POST['update'])) {
        $productosController->edit();
    } elseif (isset($_POST['delete'])) {
        $productosController->delete();
    }
}

if (isset($_GET['categoria'])) {
  $categoria = $_GET['categoria'];
  $productos = Producto::filtroCategoria($categoria);
} else if (isset($_GET['marca'])) {
  $marca = $_GET['marca'];
  $productos = Producto::filtroMarca($marca);
} else {
  $productos = Producto::listar();
}


class ProductosController {
    public function index() {
        try {
            $productos = Producto::listar();
            return $productos;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function lowStock() {
        try{
            $productos = Producto::pocoStock();
            return $productos;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function create() {
        if(isset($_POST['add'])) {
            $id_usuario = $_POST['sesion'];
            $nombre = $_POST['producto'];
            $categoria = $_POST['categoria'];
            $proveedor = $_POST['proveedor'];
            $existencia_inicial = $_POST['stock_inicial'];
            $stock_min = $_POST['stock_minimo'];
            $precio_venta = $_POST['precio'];
            $imagen = null;

            if (isset($_FILES['imagen'])) {
                $img_name = $_FILES['imagen']['name'];
                $img_type = $_FILES['imagen']['type'];
                $img_size = $_FILES['imagen']['size'];
                
                if($img_size<=1000000){
                    if($img_type=="image/jpeg" || $img_type=="image/jpg" || $img_type=="image/png"){
                        // Ruta de carpeta destino en servidor
                        $folder = $_SERVER['DOCUMENT_ROOT'] . '/market/assets/img/productos/';
                        // Mover imagen de directorio temporal al directorio escogido
                        move_uploaded_file($_FILES['imagen']['tmp_name'], $folder.$img_name);
                        $imagen = $img_name;
                    } else {
                        echo "Error: formato de imagen no válido";
                        return;
                    }
                } else {
                    echo "Error: el tamaño de la imagen es demasiado grande";
                    return;
                }
            }

            $producto = new Producto(null, $nombre, $categoria, $proveedor, $existencia_inicial, $existencia_inicial, $stock_min, $precio_venta, $imagen);
            $producto->guardar();
            registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'CREATE', 'productos');
            header("Location: ".$_SERVER['HTTP_REFERER']."");
            exit();
        }
    }

    public function edit() {
    if(isset($_POST['update'])) {
        $id_usuario = $_POST['sesion'];
        $id = $_POST['id'];
        $nombre = $_POST['producto'];
        $categoria = $_POST['categoria'];
        $proveedor = $_POST['proveedor'];
        $stock_min = $_POST['stock_minimo'];
        $precio_venta = $_POST['precio'];
        $imagen = null;

        if (isset($_FILES['imagen']) && $_FILES['imagen']['size'] > 0) {
            $img_name = $_FILES['imagen']['name'];
            $img_type = $_FILES['imagen']['type'];
            $img_size = $_FILES['imagen']['size'];
            
            if ($img_size <= 1000000) {
                if ($img_type == "image/jpeg" || $img_type == "image/jpg" || $img_type == "image/png") {

                    // Ruta de carpeta destino en servidor
                    $folder = $_SERVER['DOCUMENT_ROOT'] . '/market/assets/img/productos/';

                    // Mover imagen de directorio temporal al directorio escogido
                    move_uploaded_file($_FILES['imagen']['tmp_name'], $folder.$img_name);

                    $producto = new Producto($id, $nombre, $categoria, $proveedor, $stock_min, $precio_venta, $img_name);
                    $producto->actualizar();
                    header("Location: ".$_SERVER['HTTP_REFERER']."");
                    exit();
                } else {
                    echo "Error: Solo se permiten archivos JPEG, JPG o PNG.";
                    return;
                }
            } else {
                echo "Error: La imagen es demasiado grande, debe ser menor o igual a 1MB.";
                return;
            }
        } else {
            $producto = new Producto($id, $nombre, $categoria, $proveedor, $stock_min, $precio_venta);
            $producto->actualizar();
            registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'UPDATE', 'productos', $id);
            header("Location: ".$_SERVER['HTTP_REFERER']."");
            exit();
        }            
    }
}
    public function delete() {
        if(isset($_POST['delete'])) {
            $id = $_POST['id'];
            $id_usuario = $_POST['sesion'];
            $producto = new Producto($id);
            $producto->eliminar();
            registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'UPDATE', 'productos', $id);
            header("Location: ".$_SERVER['HTTP_REFERER']."");
            exit();
        }
    }   
}
?>
<?php
include_once 'C:/xampp/htdocs/market/model/conexion.php';

class Categoria {
    private $Id_categoria;
    private $nombre;
    private $conn;

    public function __construct($Id_categoria = null, $nombre = null) {
        $this->Id_categoria = $Id_categoria;
        $this->nombre = $nombre;
        $this->conn = Conectar::conexion();
    }

    public static function getAll() {
        $categorias = array();

        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("SELECT * FROM categorias");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categoria = new Categoria($row['Id_categoria'], $row['nombre_categoria']);
                array_push($categorias, $categoria);
            }

            $stmt = null;
            $conn = null;

            return $categorias;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function getById($Id_categoria) {
        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("SELECT * FROM categorias WHERE Id_categoria = ?");
            $stmt->bindParam(1, $Id_categoria, PDO::PARAM_INT);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categoria = new Categoria($row['Id_categoria'], $row['nombre_categoria']);
            } else {
                $categoria = null;
            }

            $stmt = null;
            $conn = null;

            return $categoria;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function save() {
        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("INSERT INTO categorias (nombre_categoria) VALUES (?)");
            $stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
            $stmt->execute();

            $this->Id_categoria = $conn->lastInsertId();

            $stmt = null;
            $conn = null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function update() {
        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("UPDATE categorias SET nombre_categoria = ? WHERE Id_categoria = ?");
            $stmt->bindParam(1, $this->nombre, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->Id_categoria, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = null;
            $conn = null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function delete() {
        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("DELETE FROM categorias WHERE Id_categoria = ?");
            $stmt->bindParam(1, $this->Id_categoria, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = null;
            $conn = null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getId() {
        return $this->Id_categoria;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}
           
?>
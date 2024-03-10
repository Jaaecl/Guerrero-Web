<?php
include_once 'C:/xampp/htdocs/market/model/conexion.php';

class Proveedor {
    private $Id_proveedor;
    private $rif;
    private $razon_social;
    private $direccion_proveedor;
    private $telefono_proveedor;
    private $correo_proveedor;
    private $conn;

    public function __construct($Id_proveedor = null, $rif = null, $razon_social = null, $direccion_proveedor = null, $telefono_proveedor = null, $correo_proveedor = null) {
        $this->Id_proveedor = $Id_proveedor;
        $this->rif = $rif;
        $this->razon_social = $razon_social;
        $this->direccion_proveedor = $direccion_proveedor;
        $this->telefono_proveedor = $telefono_proveedor;
        $this->correo_proveedor = $correo_proveedor;
        $this->conn = Conectar::conexion();
    }

    public static function getAll() {
        $proveedores = array();

        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("SELECT * FROM proveedores");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $proveedor = new Proveedor(
                    $row['Id_proveedor'],
                    $row['RIF_proveedor'],
                    $row['razon_social_proveedor'],
                    $row['direccion_proveedor'],
                    $row['telefono_proveedor'],
                    $row['correo_proveedor']
                );
                array_push($proveedores, $proveedor);
            }

            $stmt = null;
            $conn = null;

            return $proveedores;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function getById($Id_proveedor) {
        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("SELECT * FROM proveedores WHERE Id_proveedor = ?");
            $stmt->bindParam(1, $Id_proveedor, PDO::PARAM_INT);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $proveedor = new Proveedor($row['Id_proveedor'], $row['RIF_proveedor'], $row['razon_social_proveedor'], $row['direccion_proveedor'], $row['telefono_proveedor'], $row['correo_proveedor']);
            } else {
                $proveedor = null;
            }

            $stmt = null;
            $conn = null;

            return $proveedor;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function save() {
        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("INSERT INTO proveedores (RIF_proveedor, razon_social_proveedor, direccion_proveedor, telefono_proveedor, correo_proveedor) VALUES (?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $this->rif, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->razon_social, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->direccion_proveedor, PDO::PARAM_STR);
            $stmt->bindParam(4, $this->telefono_proveedor, PDO::PARAM_INT);
            $stmt->bindParam(5, $this->correo_proveedor, PDO::PARAM_STR);
            $stmt->execute();

            $this->Id_proveedor = $conn->lastInsertId();

            $stmt = null;
            $conn = null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function update() {
        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("UPDATE proveedores SET RIF_proveedor = COALESCE(?, RIF_proveedor), razon_social_proveedor = COALESCE(?, razon_social_proveedor), direccion_proveedor = COALESCE(?, direccion_proveedor), telefono_proveedor = COALESCE(?, telefono_proveedor), correo_proveedor = COALESCE(?, correo_proveedor) WHERE Id_proveedor = ?");
            $stmt->bindParam(1, $this->rif, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->razon_social, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->direccion_proveedor, PDO::PARAM_STR);
            $stmt->bindParam(4, $this->telefono_proveedor, PDO::PARAM_INT);
            $stmt->bindParam(5, $this->correo_proveedor, PDO::PARAM_STR);
            $stmt->bindParam(6, $this->Id_proveedor, PDO::PARAM_INT);
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

            $stmt = $conn->prepare("DELETE FROM proveedores WHERE Id_proveedor = ?");
            $stmt->bindParam(1, $this->Id_proveedor, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = null;
            $conn = null;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getId() {
        return $this->Id_proveedor;
    }

    public function getRif() {
        return $this->rif;
    }

    public function setRif($rif) {
        $this->rif = $rif;
    }

    public function getRazonSocial() {
        return $this->razon_social;
    }

    public function setRazonSocial($razon_social) {
        $this->razon_social = $razon_social;
    }

        public function getDireccionP() {
        return $this->direccion_proveedor;
    }

    public function setDireccionP($direccion_proveedor) {
        $this->direccion_proveedor = $direccion_proveedor;
    }

        public function getTelefonoP() {
        return $this->telefono_proveedor;
    }

    public function setTelefonoP($telefono_proveedor) {
        $this->telefono_proveedor = $telefono_proveedor;
    }

        public function getCorreoP() {
        return $this->correo_proveedor;
    }

    public function setCorreoP($correo_proveedor) {
        $this->correo_proveedor = $correo_proveedor;
    }
}
           
?>
<?php
include_once 'C:/xampp/htdocs/market/model/conexion.php';

class Usuario {
    private $id;
    private $nombre;
    private $apellido;
    private $direccion;
    private $telefono;
    private $correo;
    private $nivel;
    private $estatus;
    private $fecha_usuario;
    private $conn;

    public function __construct($id = null, $nombre = null, $apellido = null, $direccion = null, $telefono = null, $correo = null, $nivel = null, $estatus = null, $fecha_usuario = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->nivel = $nivel;
        $this->estatus = $estatus;
        $this->fecha_usuario = $fecha_usuario;
        $this->conn = Conectar::conexion();
    }

    public static function getAll() {
        $usuarios = array();

        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("SELECT * FROM usuarios");
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new Usuario(
                    $row['Id_usuario'],
                    $row['nombre_usuario'],
                    $row['apellido_usuario'],
                    $row['direccion_usuario'],
                    $row['telefono_usuario'],
                    $row['correo_usuario'],
                    $row['nivel_usuario'],
                    $row['estatus_usuario'],
                    $row['fecha_creacion_usuario']
                );
                array_push($usuarios, $usuario);
            }

            $stmt = null;
            $conn = null;

            return $usuarios;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function getById($Id_usuario) {
        try {
            $conn = Conectar::conexion();

            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE Id_usuario = ?");
            $stmt->bindParam(1, $Id_usuario, PDO::PARAM_INT);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new Usuario(
                    $row['Id_usuario'],
                    $row['nombre_usuario'],
                    $row['apellido_usuario'],
                    $row['direccion_usuario'],
                    $row['telefono_usuario'],
                    $row['correo_usuario'],
                    $row['nivel_usuario'],
                    $row['fecha_creacion_usuario'],
                    $row['estatus_usuario']
                );
            } else {
                $usuario = null;
            }

            $stmt = null;
            $conn = null;

            return $usuario;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function actualizarNivel($id_usuario, $nivel_usuario) {
        try {
            $conn = Conectar::conexion();

            $query = "UPDATE usuarios SET nivel_usuario = ? WHERE Id_usuario = ?";

            $stmt = $conn->prepare($query);

            $stmt->execute([$nivel_usuario, $id_usuario]);

            $conn = null;

            return true;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarEstatus($id_usuario, $estatus_usuario) {
        try {
            $conn = Conectar::conexion();

            $query = "UPDATE usuarios SET estatus_usuario = ? WHERE Id_usuario = ?";

            $stmt = $conn->prepare($query);

            $stmt->execute([$estatus_usuario, $id_usuario]);

            $conn = null;

            return true;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getNombreU() {
        return $this->nombre;
    }

    public function setNombreU($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellidoU() {
        return $this->apellido;
    }

    public function setApellidoU($apellido) {
        $this->apellido = $apellido;
    }

    public function getDireccionU() {
        return $this->direccion;
    }

    public function setDireccionU($direccion) {
        $this->direccion = $direccion;
    }

    public function getTelefonoU() {
        return $this->telefono;
    }

    public function setTelefonoU($telefono) {
        $this->telefono = $telefono;
    }
    public function getCorreoU() {
        return $this->correo;
    }

    public function setCorreoU($correo) {
        $this->correo = $correo;
    }

    public function getFechaU() {
        return $this->fecha_usuario;
    }

    public function setFechaU($fecha_usuario) {
        $this->fecha_usuario = $fecha_usuario;
    }
    public function getNivel() {
        return $this->nivel;
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    public function getEstatus() {
        return $this->estatus;
    }

    public function setEstatus($estatus) {
        $this->estatus = $estatus;
    }                   
}
           
?>
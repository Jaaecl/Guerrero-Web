<?php
include_once 'auditorias.php';


include_once 'C:/xampp/htdocs/market/admin/modelo/modelo_proveedores.php';
$proveedoresController = new ProveedoresController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $proveedoresController->create();
    } elseif (isset($_POST['update'])) {
        $proveedoresController->edit();
    } elseif (isset($_POST['delete'])) {
        $proveedoresController->delete();
    }
}

class ProveedoresController {
    public function index() {
        try {
            $proveedores = Proveedor::getAll();
            return $proveedores;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function create() {
        if(isset($_POST['add'])) {
            $rif = $_POST['rif'];
            $asunto = $_POST['asunto'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $id_usuario = $_POST['sesion'];
            $proveedor = new Proveedor(null, $rif, $asunto, $direccion, $telefono, $correo);
            $proveedor->save();
            registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'CREATE', 'proveedores');
            header('Location: ../vista/proveedores.php');
        }
    }

    public function edit() {
        if(isset($_POST['update'])) {
            $id = $_POST['id'];
            $rif = $_POST['rif'];
            $asunto = $_POST['asunto'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $id_usuario = $_POST['sesion'];
            $proveedor = new Proveedor($id, $rif, $asunto, $direccion, $telefono, $correo);
            $proveedor->update();
            registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'UPDATE', 'proveedores', $id);
            header('Location: ../vista/proveedores.php');
        }
    }

    public function delete() {
        if(isset($_POST['delete'])) {
            $id = $_POST['id'];
            $id_usuario = $_POST['sesion'];
            $proveedor = new Proveedor($id);
            $proveedor->delete();
            registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'UPDATE', 'proveedores', $id);
            header('Location: ../vista/proveedores.php');
        }
    }
}
?>
<?php
include_once 'auditorias.php';

include_once 'C:/xampp/htdocs/market/admin/modelo/modelo_usuarios.php';
$usuarioController = new UsuarioController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['change_level'])) {
        $usuarioController->changeLevel();
    }elseif (isset($_POST['change_status'])) {
        $usuarioController->changeStatus();
    }
}

class UsuarioController {
    public function index() {
        try {
            $usuarios = Usuario::getAll();
            return $usuarios;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function changeLevel() {
        $id = $_POST['id'];
        $nivel_usuario = $_POST['nivel'];
        $id_usuario = $_POST['sesion'];
        $usuario = new Usuario();
        $usuario->actualizarNivel($id, $nivel_usuario);
        registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'UPDATE_NIVEL', 'usuarios', $id);
        header('Location: ../vista/usuarios.php');
    }

    public function changeStatus() {
        $id = $_POST['id'];
        $estatus_usuario = $_POST['estatus'];
        $id_usuario = $_POST['sesion'];
        $usuario = new Usuario();
        $usuario->actualizarEstatus($id, $estatus_usuario);
        registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'UPDATE_STATUS', 'usuarios', $id);
        header('Location: ../vista/usuarios.php');
        
    }



}


?>
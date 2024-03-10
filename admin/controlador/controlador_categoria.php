<?php
include_once 'auditorias.php';


include_once 'C:/xampp/htdocs/market/admin/modelo/modelo_categoria.php';
$categoriasController = new CategoriasController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $categoriasController->create();
    } elseif (isset($_POST['update'])) {
        $categoriasController->edit();
    } elseif (isset($_POST['delete'])) {
        $categoriasController->delete();
    }
}

class CategoriasController {
    public function index() {
        try {
            $categorias = Categoria::getAll();
            return $categorias;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function create() {
        if(isset($_POST['add'])) {
            $nombre = $_POST['categoria'];
            $id_usuario = $_POST['sesion'];
            $categoria = new Categoria(null, $nombre);
            $categoria->save();
            registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'CREATE', 'categorias');
            header("Location: ".$_SERVER['HTTP_REFERER']."");
        }
    }

    public function edit() {
        if(isset($_POST['update'])) {
            $id = $_POST['id'];
            $nombre = $_POST['categoria'];
            $id_usuario = $_POST['sesion'];
            $categoria = new Categoria($id, $nombre);
            $categoria->update();
            registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'UPDATE', 'categorias', $id);
            header("Location: ".$_SERVER['HTTP_REFERER']."");
        }
    }

    public function delete() {
        if(isset($_POST['delete'])) {
            $id = $_POST['id'];
            $id_usuario = $_POST['sesion'];
            $categoria = new Categoria($id);
            $categoria->delete();
            registrarAccion($id_usuario, $_SERVER['REMOTE_ADDR'], 'DELETE', 'categorias');
            header("Location: ".$_SERVER['HTTP_REFERER']."");
        }
    }
}
?>
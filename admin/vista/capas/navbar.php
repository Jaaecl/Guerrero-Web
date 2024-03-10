<?php
session_start();
$nivel_usuario = $_SESSION['nivel'];
$user_id = $_SESSION['ID'];
if ($nivel_usuario != "administrador") {
  header("Location: /market/index.php");
}
?>
<?php
$file = __DIR__ . '/../../../dolar.txt';
$dolar = file_get_contents($file);
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <form method="POST" action="/market/admin/controlador/actualizar_dolar.php">
    <div class="input-group input-group-sm">
      <input type="text" class="form-control" id="nuevo_valor" name="nuevo_valor" placeholder="<?php echo "Precio del dólar: " . $dolar; ?>">
      <div class="input-group-append">
        <button type="submit" class="btn btn-secondary ml-2">Actualizar</button>
      </div>
    </div>
  </form>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="/market/controller/close-session.php" role="button" title="cerrar sesion">
        <i class="fa-solid fa-right-from-bracket" style="color: #1c2331;"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<?php
$file = __DIR__ . '/../../dolar.txt';
$dolar = file_get_contents($file);

session_start();

// Verificar si la variable de sesión 'user_id' está definida y no está vacía
if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
  // El usuario ha iniciado sesión
  $isLoggedIn = true;
  include('C:/xampp/htdocs/market/controller/sum.php');
  $usuario = $_SESSION['usuario'];
  $carrito = new Carrito($con);
  $cantidad_total = $carrito->getCantidadTotal($usuario);
} else {
  // El usuario no ha iniciado sesión
  $isLoggedIn = false;
}

?>

<head>
  <!-- Iconos de la ventana -->
  <link href="/market/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/market/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="/market/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" type="text/css">
  <link href="/market/assets/vendor/aos/aos.css" rel="stylesheet" type="text/css">
  <link href="/market/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" type="text/css">
  <link href="/market/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css">
  <!-- Template Main CSS File -->
  <link href="/market/assets/css/main.css" rel="stylesheet" type="text/css">
  <link href="/market/assets/icons/fontawesome-free-6.4.0-web/css/all.min.css" rel="stylesheet">
</head>

<!-- ======= Header ======= -->

<section id="topbar" class="topbar d-flex align-items-center">
  <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center">
      <i class="bi bi-currency-dollar d-flex align-items-center"><span><?php echo 'Precio del dólar: ' . $dolar . "(BCV)"; ?></span></i>
    </div>
    <div class="social-links d-none d-md-flex align-items-center">
      <?php if ($isLoggedIn == false) : ?>
        <a href="/market/view/login.php" class="user" title="Iniciar sesión"><i class="fa-solid fa-circle-user"></i></a>
        <a href="/market/view/login.php" class="cart" title="ingresa para ver tu carro"><i class="fa-solid fa-cart-shopping"></i></a>
      <?php else : ?>
        <span style="color: #222222;" style="color: #222222;"> <?php echo "Bienvenido, " . $_SESSION['nombre']; ?></span>
        <a href="/market/view/carro.php" class="cart" title="Mi carro"><i class="fa-solid fa-cart-shopping"></i><?php echo "($cantidad_total)"; ?></a>
        <?php if ($_SESSION['nivel'] == "administrador") : ?>
          <a href="/market/admin/home.php"><i class="fa-solid fa-shop" title="Administrador"></i></a>
        <?php endif; ?>
        <a href="/market/controller/close-session.php"><i class="fa-solid fa-right-from-bracket" title="cerrar sesion"></i></a>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- End Top Bar -->

<header id="header" class="header d-flex align-items-center">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <a href="/market/index.php" class="logo d-flex align-items-center">
      <img src="/market/assets/img/logo.png" alt="Logo">
    </a>
    <nav id="navbar" class="navbar">
      <ul>
        <li><a href="/market/index.php">Inicio</a></li>
        <li><a href="/market/view/nosotros.php">Nosotros</a></li>
        <li class="dropdown"><a href="/market/view/tienda.php"><span>Tienda</span></a></li>
        <li><a href="/market/view/contacto.php">Contacto</a></li>
      </ul>
    </nav><!-- .navbar -->
    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
  </div>
</header>
<!-- End Header -->
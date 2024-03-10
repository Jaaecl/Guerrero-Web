
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
  <title>Nosotros - Supermercado El Bosque</title>
  <link href="../assets/img/favicon-16x16.png" rel="icon">
</head>
<body>
  <?php include('layouts/header.php'); ?>
  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <nav>
        <div class="container">
          <ol>
            <li><a href="../index.php">Inicio</a></li>
            <li>Nosotros</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="section-header">
          <h2>Nosotros</h2>
        </div>
        <div class="row gy-4">
          <div class="col-lg-6">
            <img src="../assets/img/US/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
          </div>
          <div class="col-lg-6">
            <div class="content ps-0 ps-lg-5">
              <p><h3>Nuestra historia</h3></p>
              <p class="fst-italic">
                Somos un supermercado con tres años de experiencia brindando una gran variedad de productos de la
                mejor calidad y frescura a nuestros clientes ofreciendo un excelente servicio, siempre renovando nuestra imagen,
                buscando refrescarla y adecuarla a los nuevos tiempos.
              </p>
              <ul>
                <h2>Misión</h2>
                <li><i class="bi bi-check-circle-fill"></i> Comercializar productos de consumo masivo de excelente calidad a los mejores precios del mercado,
                  brindando la mejor opción en surtido, orientado a satisfacer las necesidades de los clientes,
                  acompañado de un buen servicio y atención.</li>
                <br>
                <h2>Visión</h2>
                <li><i class="bi bi-check-circle-fill"></i> Ser una de las empresas líderes a nivel nacional, ofreciendo siempre productos de excelente calidad,
                  al mejor precio, con tiendas amplias, cómodas y modernas,
                  que brinden seguridad y confianza a nuestros clientes que son nuestra razón de ser.</li>
              </ul>
              <div class="position-relative mt-4">
                <img src="assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End About Us Section -->
    <!-- ======= Brands Section ======= -->
    <section id="clients" class="clients">
      <div class="section-header">
        <h2>Encuentra las mejores marcas</h2>
      </div>
      <div class="container">

        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="../assets/img/brands/bimbo.png" class="img-fluid" alt="bimbo"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/cocacola.png" class="img-fluid" alt="coca_cola"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/colcafe.jpg" class="img-fluid" alt="colcafe"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/kellogs.png" class="img-fluid" alt="kellogs"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/kraftheinz.png" class="img-fluid" alt="kraft_heinz"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/lasllaves.jpg" class="img-fluid" alt="las_llaves"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/mary.png" class="img-fluid" alt="mary"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/montalban.png" class="img-fluid" alt="montalban"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/nestle.png" class="img-fluid" alt="nestle"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/pantera.png" class="img-fluid" alt="pantera"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/plumrose.png" class="img-fluid" alt="plumrose"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/polar.jpg" class="img-fluid" alt="polar"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/ronco.png" class="img-fluid" alt="ronco"></div>
            <div class="swiper-slide"><img src="../assets/img/brands/savoy.png" class="img-fluid" alt="savoy"></div>
          </div>
        </div>
      </div>
    </section><!-- End Brands Section -->
    <!-- ======= Payment Method ======= -->
    <section id="services" class="services sections-bg">
      <div class="container">
        <div class="section-header">
          <h2>Métodos de Pago</h2>
          <p>Averigua cómo pagar tus productos</p>
        </div>
          <div class="row" style="box-sizing: border-box;">
            <div class="column" style="float: left;width: 33.33%;padding: 5xp;">
              <img src="../assets/img/US/national_paym.jpg" alt="metodos-nacionales" style="width:100%;border-radius: 10px;float: left;margin-left: 50%;">
            </div>
            <div class="column" style="float: left;width: 33.33%;padding: 5xp;">
              <img src="../assets/img/US/international_paym.png" alt="metodos-internacionales" style="width:100%;border-radius: 10px;float: left;margin-left: 50%;">
            </div>
          </div>
        </div>
    </section><!-- End Payment Method -->
    <!-- ======= Our Services Section ======= -->
    <section id="payment">
      <div class="container">
        <div class="section-header">
          <h2>Compras Online y Delivery</h2>
          <p>Sabemos la dificultad que tienen muchos de nuestros clientes de conseguir tiempo para ir a hacer las compras en nuestra sucursal, gracias a la innovación de la tecnología tenemos ahora la posibilidad de ofrecer un servicio online de gran comodidad y eficiencia a través del cual se pueden realizar compras de manera digital y llevamos directo a tu hogar tus compras por nuestro servicio de delivery. <a href="tienda.php">Haz tus compras aquí.</a></p>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
  <?php include('layouts/footer.php'); ?>
</body>
</html>
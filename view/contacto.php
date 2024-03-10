<!doctype html>
<html>

<head>
  <title>Contacto - Supermercado El Bosque</title>
  <link href="../assets/img/favicon-16x16.png" rel="icon">
</head>

<body>
  <?php include('layouts/header.php'); ?>
  <!-- ======= Breadcrumbs ======= -->
  <div class="breadcrumbs">
    <nav>
      <div class="container">
        <ol>
          <li><a href="../index.php">Inicio</a></li>
          <li>Contacto</li>
        </ol>
      </div>
    </nav>
  </div><!-- End Breadcrumbs -->
  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

      <div class="section-header">
        <h2>Contacto</h2>
      </div>

      <div class="row gx-lg-0 gy-4">

        <div class="col-lg-4">

          <div class="info-container d-flex flex-column align-items-center justify-content-center">
            <div class="info-item d-flex">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h4>Ubicación:</h4>
                <p>Av. Las Delicias, Urb. El Bosque, C.C. Regional, Maracay</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
              <i class="fa-brands fa-whatsapp"></i>
              <div>
                <h4>Teléfono:</h4>
                <p>+58 424 327 7783</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex">
              <i class="fa-regular fa-clock"></i>
              <div>
                <h4>Horario:</h4>
                <p>Lunes a Domingo: 8AM - 8PM</p>
              </div>


            </div><!-- End Info Item -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15704.036885756881!2d-67.5892307!3d10.2608393!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd1148a63b36545cf!2sSupermercado%20EL%20BOSQUE!5e0!3m2!1ses!2sve!4v1672281625474!5m2!1ses!2sve" width="100%" height="290px" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

        </div>

        <div class="col-lg-8">
          <form action="../controller/phpmailer/mail.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" required autocomplete="off">
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <label for="name">Correo</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Correo" required autocomplete="off">
              </div>
            </div>
            <div class="form-group mt-3">
              <label for="name">Asunto</label>
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" required autocomplete="off">
            </div>
            <div class="form-group mt-3">
              <label for="name">Mensaje</label>
              <textarea class="form-control" name="message" rows="7" placeholder="Mensaje" required autocomplete="off"></textarea>
            </div>
            <div class="text-center"><button type="submit">Enviar Mensaje</button></div>
          </form>
        </div><!-- End Contact Form -->

      </div>

    </div>
  </section><!-- End Contact Section -->
  <?php include('layouts/footer.php'); ?>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
	<!-- Favicons -->
	<link href="../assets/img/icon.png" rel="icon">
	<link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
	<!-- Bootstraop CSS -->
	<link href="../assets/css/3.3.0.bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<!-- Stylesheet -->
	<link rel="stylesheet" href="../assets/css/log.css">
	<!-- Bootstrap JS -->
	<script src="../assets/js/4.1.1.bootstrap.min.js"></script>
	<script src="../assets/js/3.2.1.jquery.min.js"></script>
	<title>Ingresar</title>
</head>

<body>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-6">
							<a href="#" class="active" id="login-form-link">Iniciar Sesión</a>
						</div>
						<div class="col-xs-6">
							<a href="#" id="register-form-link">Registrarse</a>
						</div>
					</div>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<!--LOGIN FORM-->
							<form id="login-form" action="/market/controller/login-auth.php" method="post" role="form" style="display: block;">
								<div class="col-xs-10 form-group">
									<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Correo" value="" required autocomplete="off">
								</div>
								<div class="col-xs-10 form-group">
									<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña" required autocomplete="off">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Iniciar Sesión">
											<?php

											if (isset($_GET['error']) && $_GET['error'] == 1) {
												echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
											}


											if (isset($_GET['error']) && $_GET['error'] == 2) {
												echo "<p style='color:red;'>Por favor ingrese una misma contraseña.</p>";
											}

											if (isset($_GET['error']) && $_GET['error'] == 3) {
												echo "<p style='color:red;'>Su cuenta ha sido desactivada.</p>";
											}
											?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-12">
											<div class="text-center">
												<a href="#" tabindex="5" class="forgot-password" id="recover-form-link">¿Olvidaste tu contraseña?</a>
											</div>
										</div>
									</div>
								</div>
							</form>
							<!--END LOGIN FORM-->

							<!--RECOVER PASSWORD FORM-->
							<form id="recover-form" action="/market/controller/recover-password.php" method="post" role="form" style="display: none;">
								<div class="col-xs-10 form-group">
									<input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Correo" value="" required autocomplete="off">
								</div>
								<div class="col-xs-10 form-group">
									<input type="password" name="new-password" id="password" tabindex="2" class="form-control" placeholder="Nueva contraseña" required autocomplete="off">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Enviar">
										</div>
									</div>
								</div>
							</form>
							<!--END  RECOVER PASSWORD FORM-->

							<!--REGISTER FORM-->
							<form id="register-form" action="../controller/register.php" method="post" role="form" style="display: none;">
								<div class="col-xs-10 form-group">
									<input type="text" name="name" id="username" tabindex="1" class="form-control" placeholder="Nombre" value="" required autocomplete="off">
								</div>
								<div class="col-xs-10 form-group">
									<input type="text" name="lastname" id="username" tabindex="1" class="form-control" placeholder="Apellido" value="" required autocomplete="off">
								</div>
								<div class="col-xs-10 form-group">
									<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Correo" value="" required autocomplete="off">
								</div>
								<div class="col-xs-10 form-group">
									<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña" required autocomplete="off">
								</div>
								<div class="col-xs-10 form-group">
									<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirmar contraseña" required autocomplete="off">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrarse">
										</div>
									</div>
								</div>
							</form>
							<!--END REGISTER FORM-->

							<script>
								$(function() {

									$('#login-form-link').click(function(e) {
										$("#login-form").delay(100).fadeIn(100);
										$("#register-form").fadeOut(100);
										$('#register-form-link').removeClass('active');
										$("#recover-form").fadeOut(100);
										$('#recover-form-link').removeClass('active');
										$(this).addClass('active');
										e.preventDefault();
									});
									$('#register-form-link').click(function(e) {
										$("#register-form").delay(100).fadeIn(100);
										$("#login-form").fadeOut(100);
										$('#login-form-link').removeClass('active');
										$("#recover-form").fadeOut(100);
										$('#recover-form-link').removeClass('active');
										$(this).addClass('active');
										e.preventDefault();
									});

									$('#recover-form-link').click(function(e) {
										$("#recover-form").delay(100).fadeIn(100);
										$("#login-form").fadeOut(100);
										$('#recover-form-link').removeClass('active');
										$(this).addClass('active');
										e.preventDefault();
									});

								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

</body>

</html>
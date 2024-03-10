<?php 
if(isset($_POST['check'])){
  session_start(); 
  include_once('C:/xampp/htdocs/market/controller/sum.php');
  $delivery = $_POST['entrega'];
  if($delivery==1.5){
    $entrega="Delivery";
  }else{
    $entrega="Take_Away";
  }
  $usuario = $_SESSION['usuario'];
  $identificacion=$_SESSION["ID"];
  $carrito = new Carrito($con);
  $cantidad_total = $carrito->getCantidadTotal($usuario);
}else{
  echo "llene su carro primero";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link href="../assets/img/favicon-16x16.png" rel="icon">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/checkout.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
      <?php
      $sql = "SELECT * FROM carrito WHERE usuario = :usuario";
      $stmt = $con->prepare($sql);
      $stmt->execute(array(':usuario' => $_SESSION['usuario']));
      $subtotal = 0;
      ?>
      <main>
        <div class="py-5 text-center">
          <img class="d-block mx-auto mb-4" src="../assets/img/android-chrome-512x512.png" alt="logo" width="72" height="60">
          <h2>Formulario de Pago</h2>
        </div>
        <div class="row g-5">
          <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-primary">Tu carro</span>
              <span class="badge bg-primary rounded-pill"><?php echo $cantidad_total;?></span>
            </h4>
            
            <ul class="list-group mb-3">
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $product_id = $row['id_producto'];
              $product_name = $row['titulo_producto'];
              $product_price = $row['precio_producto'];
              $product_image = $row['foto_producto'];
              $product_qty = $row['cantidad'];
              $subtotal += $product_price;
              $iva = 0.16;
              $total = $subtotal+$iva+$delivery;
            ?>
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                  <h6 class="my-0"><?php echo $product_qty .' '. $product_name; ?></h6>
                  <small class="text-muted">Bebidas</small>
                </div>
                <span class="text-muted"><?php echo "$".$product_price; ?></span>
              </li>
              <?php
              }
              ?>
              <li class="list-group-item d-flex justify-content-between">
                <span>Subtotal</span>
                <strong><?php echo "$". $subtotal; ?></strong>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>Delivery</span>
                <strong><?php echo "$". $delivery; ?></strong>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>IVA</span>
                <strong><?php echo "$". $iva; ?></strong>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>Total (USD)</span>
                <strong><?php echo "$". $total; ?></strong>
              </li>
            </ul>
          </div>

          <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Datos Personales</h4>
            <form action="../controller/facturacion.php" method="post" enctype="multipart/form-data">
              <div class="row g-3">

                <div class="col-12">
                  <label for="address" class="form-label">Dirección</label>
                  <input type="text" class="form-control" id="address" placeholder="Dirección" name="direccion" required autocomplete="off">
                </div>

                <div class="col-12">
                  <label for="address2" class="form-label">Teléfono</label>
                  <input type="text" class="form-control" id="address2" placeholder="0000-000-0000" name="telefono" required autocomplete="off">
                </div>

                <hr class="my-4">

                <h4 class="mb-3">Método de pago</h4>

                <div class="my-3">
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="pagoMovil" name="metodoPago" value="PagoMovil" required="required">
                    <label class="form-check-label">Pago Móvil</label>
                  </div>
                  <div class="form-check">
                    <input type="radio" class="form-check-input" id="transferencia" name="metodoPago" value="Transferencia">
                    <label class="form-check-label">Transferencia</label>
                  </div>
                </div>

                <div class="row gy-3">
                  <div id="pago_movil_info" style="display: none;">
                    <h3>Pago Móvil</h3>
                    <p>Envía el pago al siguiente número de teléfono:</p>
                    <p>0412-463-2130</p>
                    <p>Banesco</p>
                    <p>Cédula: 15.649.870</p>
                    <p>Inserta el comprobante de pago abajo:</p>
                    <input type="file" name="imagen" id="pagoMovil_imagen">
                  </div>

                  <div id="transferencia_bancaria_info" style="display: none;">
                    <h3>Transferencia Bancaria</h3>
                    <p>Realiza la transferencia a la siguiente cuenta:</p>
                    <p>Banco: Banesco</p>
                    <p>Número de cuenta: 123456789</p>
                    <p>Titular: Supermercado El Bosque</p>
                    <p>Inserta el comprobante de pago abajo:</p>
                    <input type="file" name="imagen" id="transferencia_imagen">
                  </div>
                </div>


                </div>
                <hr class="my-4">
                <input type="hidden" name="id_usuario" value="<?php echo $identificacion; ?>">
                <input type="hidden" name="iva" value="<?php echo $iva; ?>" >
                <input type="hidden" name="precio_delivery" value="<?php echo $delivery; ?>" >
                <input type="hidden" name="entrega" value="<?php echo $entrega; ?>" >
                <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>" >
                <input type="hidden" name="total" value="<?php echo $total; ?>" >
                <input type="hidden" name="cantidad_total" value="<?php echo $cantidad_total; ?>" >
                <button class="w-100 btn btn-primary btn-lg" type="submit" name="checkout">Confirmar</button>
            </form>
          </div>
        </div>
      </main>
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <a class="mb-1" href="carro.php">Volver al carro</a>
      </footer>
    </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/options.js"></script>
    <script src="../assets/js/required.js"></script>
  </body>
</html>

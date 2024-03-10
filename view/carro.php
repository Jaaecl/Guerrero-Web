<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location:login.php");
}

include_once('C:/xampp/htdocs/market/controller/sum.php');
$usuario = $_SESSION['usuario'];
$carrito = new Carrito($con);
$cantidad_total = $carrito->getCantidadTotal($usuario);
?>
<!doctype html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Carrito de Compras</title>
    <link href="../assets/img/favicon-16x16.png" rel="icon">
    <link href='../assets/css/4.3.1bootstrap.min.css' rel='stylesheet'>
    <script src="../assets/js/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/cart.css">
</head>

<body class='snippet-body'>
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4><b>Tu Carro</b></h4>
                        </div>
                        <div class="col align-self-center text-right text-muted"><?php echo $cantidad_total; ?> productos</div>
                    </div>
                </div>
                <div class="row border-top border-bottom">
                    <?php
                    // Hacer una consulta para recuperar los productos del usuario actual
                    $sql = "SELECT * FROM carrito WHERE usuario = :usuario";
                    $stmt = $con->prepare($sql);
                    $stmt->execute(array(':usuario' => $_SESSION['usuario']));
                    $subtotal = 0;
                    $entrega = 0;
                    $iva = 0.16;
                    $total = 0;
                    // Mostrar el contenido del carrito de compras si no está vacío
                    if ($stmt->rowCount() > 0) {
                        // Mostrar la tabla con el contenido del carrito de compras
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $product_id = $row['id_producto'];
                            $product_name = $row['titulo_producto'];
                            $product_price = $row['precio_producto'];
                            $product_image = $row['foto_producto'];
                            $product_qty = $row['cantidad'];
                            $subtotal += $product_price;
                            $total = $subtotal + $iva + $entrega;
                    ?>
                            <div class="row main align-items-center">
                                <div class="col-2"><img class="img-fluid" src="<?php echo $product_image; ?>"></div>
                                <div class="col">
                                    <div class="row"><?php echo $product_name; ?></div>
                                </div>
                                <div class="col">
                                    <a href="../controller/decrement.php?id=<?php echo $product_id; ?>">-</a><span class="border"><?php echo $product_qty; ?></span><a href="../controller/increment.php?id=<?php echo $product_id; ?>">+</a>
                                </div>
                                <div class="col"><?php echo "$" . $product_price; ?> <a href="../controller/deletecart.php?id=<?php echo $product_id; ?>" class="close" title="Eliminar">&#10005;</a></div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No hay productos en el carrito</p>";
                    }
                    ?>
                </div>
                <div class="back-to-shop"><a href="tienda.php"><i class="fa fa-long-arrow-left"></i><span class="text-muted"> Volver a la tienda</span></a></div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Resumen</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">ITEMS: <?php echo $cantidad_total; ?></div>
                    <div class="col text-right"><?php echo "$" . $subtotal; ?></div>
                </div>
                <form action="checkout.php" method="post">
                    <p>Entrega</p>
                    <select id="deliverySelect" name="entrega" onchange="updateTotal()">
                        <option value="" class="text-muted" selected disabled>Entrega</option>
                        <option value=1.5 class="text-muted">Delivery - $1.5</option>
                        <option value=0 class="text-muted">Take away</option>
                    </select>
                    <hr class="line">
                    <div class="d-flex justify-content-between information">Subtotal <span><?php echo "$" . $subtotal; ?></span></div>
                    <div class="d-flex justify-content-between information">Envío <span id="entregaMostrada"><?php echo $entrega; ?></span></div>
                    <div class="d-flex justify-content-between information">IVA <span><?php echo $iva; ?></span></div>
                    <div class="d-flex justify-content-between information">Total <span id="total"><?php echo "$" . $total; ?></span></div>
                    <button type="submit" class="btn" name="check">PAGAR</button>
                </form>
            </div>
        </div>
    </div>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script>
        function updateTotal() {
            var deliverySelect = document.getElementById("deliverySelect");
            var entrega = parseFloat(deliverySelect.options[deliverySelect.selectedIndex].value);
            var subtotal = <?php echo $subtotal ?>;
            var iva = <?php echo $iva ?>;
            total = subtotal + iva + entrega;
            document.getElementById("total").innerHTML = "$" + total.toFixed(2);
            var entregaMostrada = document.getElementById("entregaMostrada");
            entregaMostrada.innerHTML = entrega.toFixed(2);
        }
    </script>
</body>

</html>
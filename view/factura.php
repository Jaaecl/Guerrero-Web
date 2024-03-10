<?php

include("../controller/factura_controlador.php"); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Factura</title>
    <link href="../assets/img/favicon-16x16.png" rel="icon">
    <link href="../assets/css/factura.css" rel="stylesheet">

    <!-- REQUIRED SCRIPTS -->
    <link rel="stylesheet" href="../admin/assets/dist/css/adminlte.min.css">
    <script type="text/javascript" src="../assets/js/html2canvas.min.js"></script>
</head>

<body>
    <div class="invoice-container">
        <div class="header">
            <div class="company-info">
                <img src="../assets/img/logo.png" width="70%">
                <p>Nombre del cliente: <?php echo $factura['nombre_usuario'] . " " . $factura['apellido_usuario']; ?></p>
            </div>
            <div class="invoice-info">
                <h2>Factura</h2>
                <p>Número de factura: <?php echo $factura['nro_factura']; ?></p>
                <p>Fecha: <?php echo $factura['fecha_factura']; ?></p>
                <p>Hora: <?php echo $factura['hora_factura']; ?></p>
            </div>
        </div>
        <div class="main">
            <table>
                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalles_pedido as $detalle) : ?>
                        <?php $subtotal = $detalle['cantidad_producto_pedido'] * $detalle['precio_producto_pedido']; ?>
                        <tr>
                            <td><?php echo $detalle['cantidad_producto_pedido'] ?></td>
                            <td><?php echo $detalle['nombre_producto'] ?></td>
                            <td>$<?php echo $detalle['precio_producto_pedido'] ?></td>
                            <td>$<?php echo $subtotal ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="totals">
            <div class="subtotal">
                <p>Subtotal: $<?php echo $factura['subtotal_factura']; ?></p>
                <hr>
                <p>IVA (16%): $<?php echo $factura['factor_iva_factura']; ?></p>
                <hr>
                <p>Delivery: $<?php echo $factura['precio_delivery']; ?></p>
                <hr>
                <p>Total: $<?php echo $factura['total_factura']; ?></p>
            </div>
            <div class="taxes">

            </div>
            <div class="total">

            </div>
        </div>
        <div class="footer">

        </div>
    </div>
    <button id="btnCapturar">Guardar factura</button>
    <a href="../index.php">Volver a inicio</a>

    <script>
        const $boton = document.querySelector("#btnCapturar"), // El botón que desencadena
            $objetivo = document.body; // A qué le tomamos la fotocanvas
        // Nota: no necesitamos contenedor, pues vamos a descargarla
        // Agregar el listener al botón
        $boton.addEventListener("click", () => {
            html2canvas($objetivo) // Llamar a html2canvas y pasarle el elemento
                .then(canvas => {
                    // Cuando se resuelva la promesa traerá el canvas
                    // Crear un elemento <a>
                    let enlace = document.createElement('a');
                    enlace.download = "factura.png";
                    // Convertir la imagen a Base64
                    enlace.href = canvas.toDataURL();
                    // Hacer click en él
                    enlace.click();
                });
        });
    </script>
    </div>
</body>

</html>
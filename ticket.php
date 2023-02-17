<?php 
session_start();
if (isset($_POST['pago_final'])) {
    die("<link rel='stylesheet' href='css/estilo.css'><div class='overlay'></div><div  class='error'>Gracias por su compra " . $_SESSION['usuario'] . "<a href='index.php'>Volver a iniciar sesión</a></div>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Document</title>
</head>
<body>
    <div class="overlay"></div>
    <div class="ticket">
        <div class="info">
            <h3>Ticket</h3>
            <h5> Comprador: <?php echo $_SESSION['usuario']; ?> </h5>
            <h5> <?php echo date('d-m-Y H:i:s'); ?> </h5>
        </div>
        <div class="product">
            <?php
                $total = 0;
                foreach ($_SESSION['lista'] as $value) {
                    $split = explode(" | ", $value);
                    $total += floatval($split[2]);
                    echo "<div>$value</div>";
                }
                echo "</div><div class='total'><p>Total: $total €</p></div>";
            ?>
        <div class="pagar">
            <form action="ticket.php" method="post">
                <button type="submit" name="pago_final"><h2>Pagar</h2></button>
            </form>
        </div>
    </div>  
</body>
</html>
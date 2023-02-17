<?php
include_once("include/bbddGestion.php");
session_start();
if (!isset($_SESSION['lista'])) {
    $_SESSION['lista'] = array();
}
if (!isset($_SESSION['usuario'])) {
    die("<link rel='stylesheet' href='css/estilo.css'><div class='overlay'></div><div  class='error'>Error - debe <a href='index.php'>identificarse</a></div>");
}
if (isset($_POST['exit'])) {
    session_unset();
    unset($_SESSION['usuario']);
    header("Location: index.php");
}
if (isset($_POST['annadir'])) {
    $producto = $_POST['codigo'] . " | " . $_POST['nombre'] . " | " . $_POST['precio'];
    if (!in_array($producto, $_SESSION['lista'])) {
        array_push($_SESSION['lista'], $producto);
    }
}
if (isset($_POST['vaciar'])) {
    unset($_SESSION['lista']);
}
if (isset($_POST['comprar'])) {
    unset($_SESSION['usuario']);
    header("Location: ticket.php");
    //die("<link rel='stylesheet' href='css/estilo.css'><div class='overlay'></div><div  class='error'>Gracias por su compra " . $_SESSION['usuario'] . "<a href='index.php'>Volver a iniciar sesión</a></div>");
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
    <div class="portada">
        <h1>Listado de productos</h1>
    </div>
    <div class="todo">
        <div class="productos">
            <div class="producto">
                <?php
                    try {
                        $array_de_productos = GestionBBDD::productos();
                        foreach ($array_de_productos as $pro) {
                            $boton = "<form id='formAnnadir' action='indexCesta.php' method='post'>
                            <input type='hidden' name='codigo' value='".$pro->getCodigoProducto()."'/>
                            <input type='hidden' name='nombre' value='".$pro->getAbreviaturaProducto()."'/>
                            <input type='hidden' name='precio' value='".$pro->getPvpProducto()."'/>
                            <input type='submit' name='annadir' value='Añadir' class='boton'/></form>";
                            //$boton = "<button>Añadir</button>";
                            $cod = $pro->getCodigoProducto();
                            $name = $pro->getAbreviaturaProducto();
                            $precio = $pro->getPvpProducto();
                            echo "<div>$boton $cod | $name | $precio</div>";
                        }
                    } catch (Exception $e) {
                        echo  "<br> ERROR" . $e->getMessage();
                    }
                ?>
            </div>
        </div>
        <div class="cesta">
            <div class="carrito">
                <img src="imagenes/cesta.png">
                <h3>Cesta</h3>
            </div>
            <div class="botones">
                <?php
                    if (isset($_SESSION['lista'])) {
                        foreach ($_SESSION['lista'] as $value) {
                            echo $value . "</br>";
                        }
                    }
                ?>
                <form action="indexCesta.php" method="post">
                    <button type="submit" name="vaciar">Vaciar cesta</button>
                    <button type="submit" name="comprar">Comprar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer">
        <form action="indexCesta.php" method="post">
            <button type="submit" name="exit"><a href="index.php">Desconectar usuario</a></button>
        </form>
    </div>
</body>
</html>
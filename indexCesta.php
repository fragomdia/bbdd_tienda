<?php
session_start();
include_once("include/bbddGestion.php");
$_SESSION['lista'] = array();
if (!isset($_SESSION['usuario'])) {
    die("<link rel='stylesheet' href='css/estilo.css'><div class='overlay'></div><div  class='error'>Error - debe <a href='index.php'>identificarse</a></div>");
}
if (isset($_POST['exit'])) {
    session_unset();
    header("Location: index.php");
}
if (isset($_POST['annadir'])) {
    $producto = $_POST['codigo'] . " | " . $_POST['nombre'] . " | " . $_POST['precio'];
    array_push($_SESSION['lista'], $producto);
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
                    foreach ($_SESSION['lista'] as $value) {
                        echo $value;
                    }
                ?>
                <button>Vaciar cesta</button>
                <button>Comprar</button>
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
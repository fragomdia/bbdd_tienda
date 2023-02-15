<?php
include_once("include/bbddGestion.php");
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
                            $boton = "<button>Añadir</button>";
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
                <button>Vaciar cesta</button>
                <button>Comprar</button>
            </div>
        </div>
    </div>
</body>
</html>
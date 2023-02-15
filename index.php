<?php
//include_once("include/clases/usuario.php");
include_once("include/bbddGestion.php");

if(isset($_POST['enviar'])) {
    $nombre = $_POST['user'];
    $password = $_POST['password'];
    if (empty($nombre) || empty($password)) 
            $error = "*Debes introducir un nombre de usuario y una contraseña";
    else {
        try {
            $usuario = GestionBBDD::buscarUsuario($nombre, $password);
            if ($nombre == $usuario->getNombreUsuario() && MD5($password) == $usuario->getPasswordUsuario()) {
                session_start();
                $_SESSION['usuario'] = $nombre;
                header("Location: subIndex.php");
            } else {
                $error = "**Usuario inexistente o incorrecto";
            }
        } catch (Exception $e) {
            echo  "<br> ERROR" . $e->getMessage();
        }
    }
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
    <fieldset>
        <legend>LOGIN</legend>
        <form action="index.php" method="post" autocomplete="off">
            <div><span class=''><?php if (isset($_POST['enviar'])) echo $error; ?></span></div>
            <div>
                <label>Username</label>
                <input type="text" name="user">
            </div>
            <div>
                <label>Password&nbsp;</label>
                <input type="password" name="password">
            </div>
            <div class="boton">
                <input type="submit" name="enviar" value="Enviar">
            </div>
        </form>
    </fieldset>
</body>
</html>
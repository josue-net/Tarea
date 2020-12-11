<?php
 $conexion = new mysqli('localhost', 'root','12345678', 'diario',3360);
 if ($conexion->connect_error) die ("Fatal error");
ECHO "<center><h1>DIARIO PERSONAL</h1>";
echo <<<_END
<html>
    <head>
        <title>DIARIO PERSONA</title>
        <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cabecera.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    </head>
    <form method="post" action="contenido.php">
    <tr>¿Cual es tu Usuario?<p>
        <input type="text" name="name" placeholder="usuario"><p>
        <input type="password" placeholder="contraseña"><p>
        <input type="submit"value="Ingresar"><p>
        <h2> Aun no tienes una cuenta?</h2>
        <a href="registro.php">Registrate</a>
    </form>
    <div>
    
    </body>
</html>
_END;
function mysql_fix_string($coneccion, $string)
{
    if (get_magic_quotes_gpc())
        $string = stripcslashes($string);
    return $coneccion->real_escape_string($string);
}
function sanitizeString($var)
{
    if (get_magic_quotes_gpc())
        $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
}
?>
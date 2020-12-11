<?php
 $conexion = new mysqli('localhost', 'root','12345678', 'diario',3360);
 if ($conexion->connect_error) die ("Fatal error");
 if (isset($_POST['delete']) && isset($_POST['nombre']))
    {   
        $nombre = get_post($conexion, 'nombre');
        $query = "DELETE FROM registro WHERE nombre='$nombre'";
        $result = $conexion->query($query);
        if (!$result) echo "BORRAR falló"; 
    }

    if (isset($_POST['nombre']) &&
        isset($_POST['fecha']) &&
        isset($_POST['contenido']) )
    {
        $nombre = get_post($conexion, 'nombre');
        $fecha= get_post($conexion, 'fecha');
        $contenido = get_post($conexion, 'contenido');
        $query = "INSERT INTO registro VALUE" .
            "('$nombre', '$fecha', '$contenido')";
        $result = $conexion->query($query);
        if (!$result) echo "INSERT falló <br><br>";
    }
ECHO "<center><h1>DiArIo PeRsOnAl</h1>";
echo <<<_END
<html>
    <head>
        <title>DiArIo PeRsOnAl</title>
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/cabecera.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    </head>
    <form method="post" action="contenido.php">
    <input type="text" name="nombre" placeholder="Registra un titulo a tu diario"><p> 
    <input type="date" name="fecha"><p><br/>
    <textarea id="opinion" name="contenido"onkeyup="actualizaInfo(1000)" rows="35" cols="70" placeholder="Escribe todo lo que sientes, te escucho"></textarea><br/>
    <a href="inicio.php">salir</a><br/><input type="submit"> <input type="reset"><br/><a href="sql.php">mostrar contenido</a>
    </form>
    </body>
</html>
_END;
$query = "SELECT * FROM registro";
$result = $conexion->query($query);
if (!$result) die ("Falló el acceso a la base de datos");

$rows = $result->num_rows;

$result->close();
$conexion->close();

function get_post($con, $var)
{
    return $con->real_escape_string($_POST[$var]);
}
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
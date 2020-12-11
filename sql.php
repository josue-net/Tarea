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
ECHO "<h1>CoNtEnIdO dE tU dIaRiO pErSoNaL</h1>";
echo <<<_END
<html>
    <head>
        <title>DiArIo PeRsOnAl</title>
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/cabecera.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css">
    </head>
    </body>
</html>
_END;
    $query = "SELECT * FROM registro";
    $result = $conexion->query($query);
    if (!$result) die ("Falló el acceso a la base de datos");
    $rows = $result->num_rows;

    for ($j = 0; $j < $rows; $j++)
    {
        $row = $result->fetch_array(MYSQLI_NUM);

        $r0 = htmlspecialchars($row[0]);
        $r1 = htmlspecialchars($row[1]);
        $r2 = htmlspecialchars($row[2]);

        echo <<<_END
        <pre>
        Nombre del tema:
        $r0
        fecha:        $r1
        contenido:    $r2
        </pre>
          </pre>
        <form action='sql.php' method='post'>
        <input type='hidden' name='delete' value='yes'>
        <input type='hidden' name='nombre' value='$r0'>
        <input type='submit' value='BORRAR REGISTRO'>
        </form>
        <form action='sql.php' method='post'>
        <p>Tema nuevo que remplaza:  <input type='text' name='nombre'>
        Nueva fecha :             <input type='date' name='fecha'>
        Remplazar contenido:      <input type='text' name='contenido'>
        <input type='hidden' name='respuesta' value='yes' >
        <input type='hidden' name='texto' value='$r2' >
        <p><input type='submit' value='Texto modificado'>
        <a href="contenido.php">regresar</a> 
        <a href="inicio.php">salir</a> 
        </form>
        _END;
    }
      
    $result->close();
$conexion->close();

function get_post($con, $var)
{
    return $con->real_escape_string($_POST[$var]);
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
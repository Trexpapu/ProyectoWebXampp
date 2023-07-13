<?php
$conexion = mysqli_connect('localhost', 'root', '', 'biblioteca');
$titulo = $_POST['nombreLibro'];
$cliente = $_POST['nombreCliente'];
$apellido1 = $_POST['apellido1Cliente'];
$apellido2 = $_POST['apellido2Cliente'];
$direccion = $_POST['direccion'];
$cantidad_Libros = $_POST['cantidadLibros'];
$fecha_salida = $_POST['fechaSalida'];
$fecha_entrega = $_POST['fechaEntrega'];

$sql_cliente = "INSERT INTO cliente(`NombreClie`, `Apellido1Clie`, `Apellido2Clie`, `Direccion`) VALUES ('$cliente', '$apellido1', '$apellido2', '$direccion')";
$ID_cliente = "SELECT c.ID_cliente FROM cliente AS c ORDER BY c.ID_cliente DESC LIMIT 1";

$ID_libro = "SELECT l.ID_libro FROM libro AS l where l.Titulo='$titulo'";


$sql_prestamo = "INSERT INTO prestamo(`ID_libro`, `ID_cliente`, `fecha_salida`, `fecha_entrega`) VALUES (($ID_libro), ($ID_cliente), '$fecha_salida', '$fecha_entrega')";
$ID_prestamo = "SELECT p.ID_prestamo FROM prestamo AS p ORDER BY p.ID_prestamo DESC LIMIT 1";

$sql_contenido = "INSERT INTO contenido(`ID_prestamo`, `ID_libro`, `cantidad`) VALUES (($ID_prestamo), ($ID_libro), '$cantidad_Libros')";

mysqli_query($conexion, $sql_cliente);
mysqli_query($conexion, $sql_prestamo);
mysqli_query($conexion, $sql_contenido);
echo 'Datos ingresados correctamente...';

?>

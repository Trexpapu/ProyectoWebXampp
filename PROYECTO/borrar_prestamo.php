<?php
$conexion = mysqli_connect('localhost', 'root', '', 'biblioteca');

$nombre = $_POST['nombreCliente'];
$apellido1 = $_POST['Apellido1'];
$apellido2 = $_POST['Apellido2'];
$titulo = $_POST['tituloLibro'];

// Obtener ID_libro
$sql_libro = "SELECT ID_libro FROM libro WHERE Titulo='$titulo'";
$resultado_libro = mysqli_query($conexion, $sql_libro);
$registro_libro = mysqli_fetch_assoc($resultado_libro);
$ID_libro = $registro_libro['ID_libro'];

// Obtener ID_cliente
$sql_cliente = "SELECT ID_cliente FROM cliente WHERE NombreClie='$nombre' AND Apellido1Clie='$apellido1' AND Apellido2Clie='$apellido2'";
$resultado_cliente = mysqli_query($conexion, $sql_cliente);
$registro_cliente = mysqli_fetch_assoc($resultado_cliente);
$ID_cliente = $registro_cliente['ID_cliente'];

// Obtener ID_prestamo
$sql_prestamo = "SELECT ID_prestamo FROM prestamo WHERE ID_cliente='$ID_cliente' AND ID_libro='$ID_libro'";
$resultado_prestamo = mysqli_query($conexion, $sql_prestamo);
$registro_prestamo = mysqli_fetch_assoc($resultado_prestamo);
$ID_prestamo = $registro_prestamo['ID_prestamo'];

// Realizar las eliminaciones
$mysql_delete_contenido = "DELETE FROM contenido WHERE ID_prestamo = '$ID_prestamo' AND ID_libro = '$ID_libro'";
$mysql_delete_prestamo = "DELETE FROM prestamo WHERE ID_prestamo = '$ID_prestamo'";

mysqli_query($conexion, $mysql_delete_contenido);
mysqli_query($conexion, $mysql_delete_prestamo);

echo 'Datos borrados correctamente...';

?>
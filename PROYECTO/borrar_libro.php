<?php
$conexion = mysqli_connect('localhost', 'root', '', 'biblioteca');
$titulo = $_POST['nombreLibro'];
$nombre = $_POST['autor'];
$apellido1 = $_POST['Apellido1'];
$apellido2 = $_POST['Apellido2'];
$editorial = $_POST['editorial'];
$ID_libro = "SELECT l.ID_libro FROM libro AS l WHERE l.Titulo='$titulo'";
$ID_autor = "SELECT a.ID_autor FROM autor AS a WHERE a.Nombre='$nombre' and a.Apellido1='$apellido1' and a.Apellido2='$apellido2'";
$ID_editorial = "SELECT e.ID_editorial FROM editorial AS e WHERE e.Nombre_editorial = '$editorial'";
$mysql_delete_autor = "DELETE FROM autor WHERE ID_autor = ($ID_autor)";
$mysql_delete_editorial = "DELETE FROM editorial WHERE ID_editorial = ($ID_editorial)";
$mysql_delete_libro = "DELETE FROM libro WHERE ID_libro = ($ID_libro)";
mysqli_query($conexion, $mysql_delete_libro);
mysqli_query($conexion, $mysql_delete_autor);
mysqli_query($conexion, $mysql_delete_editorial);
echo 'Datos borrados correctamente...';

?>
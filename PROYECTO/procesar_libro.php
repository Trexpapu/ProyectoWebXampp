<?php
$conexion = mysqli_connect('localhost', 'root', '', 'biblioteca');

$titulo = $_POST['titulo'];
$isbn = $_POST['isbn'];
$anio = $_POST['anio'];
$autor = $_POST['autor'];
$apellido1 = $_POST['Apellido1'];
$apellido2 = $_POST['Apellido2'];
$editorial = $_POST['editorial'];

$sql_autor = "INSERT INTO autor(`Nombre`, `Apellido1`, `Apellido2`) VALUES ('$autor', '$apellido1', '$apellido2')";
$ID_autor = "SELECT a.ID_autor FROM autor AS a ORDER BY a.ID_autor DESC LIMIT 1";

$sql_editorial = "INSERT INTO editorial(`Nombre_editorial`) VALUES ('$editorial')";
$ID_editorial = "SELECT e.ID_editorial FROM editorial AS e ORDER BY e.ID_editorial DESC LIMIT 1";

$sql_libro = "INSERT INTO libro(`ISBN`, `Titulo`, `Anio`, `ID_autor`, `ID_editorial`) VALUES ('$isbn', '$titulo', '$anio', ($ID_autor), ($ID_editorial))";

mysqli_query($conexion, $sql_autor);
mysqli_query($conexion, $sql_editorial);
mysqli_query($conexion, $sql_libro);
echo 'Datos ingresados correctamente...';
?>

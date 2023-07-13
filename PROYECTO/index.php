<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="estilos.css?version=2">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
</head>
<body>
    <!-- aqui van la conexion php-->
<?php
    $conexion=mysqli_connect('localhost','root','', 'biblioteca');
?>

<!-- aqui esta el fondo de la pagina -->
<style>
    body{
        background-color: slategrey;
    }
    </style>
<!-- aqui van el codigo de html -->
<h1 class="titulo">Biblioteca</h1>
<div class="barra">
        <button class="boton1" onclick="ConsultaEditorial()">Editoriales</button>
     
        <button class="boton1" onclick="ConsultaAutor()">Autores</button>

        <button class="boton1" onclick="ConsultaLibro()">Libros</button>

        <button class="boton1" onclick="ConsultaPrestamo()">Prestamos</button>

        <button class="boton1" onclick="ConsultaCliente()">Cliente</button>

        <button class="boton2" onclick="FormularioLibro()">Agregar_Libro</button>

        <button class="boton2" onclick="FormularioPrestamo()">Agregar_Prestamo</button>

        <button class="boton3" onclick="BorrarLibro()">Borrar_Libro</button>
        
        <button class="boton3" onclick="BorrarPrestamo()">Borrar_Prestamo</button>
</div>
<div class="caja">
    <p>Información</p>
    
    <div id="resultado">
    </div>
    
</div>

<!-- scripts de consultas javascript con mysqlql -->
<script>
        function ConsultaEditorial() {
            var mensaje = "<?php  
                        $sql="SELECT * FROM EDITORIAL";
                        $result=mysqli_query($conexion, $sql);
                        while($mostrar=mysqli_fetch_array($result)){
                            echo 'Nombre editorial: '.$mostrar['Nombre_editorial']. '<br>';
                            }
            ?>";
            document.getElementById('resultado').innerHTML = mensaje;
        }

        function ConsultaAutor(){
            var mensaje = "<?php
                    $sql="SELECT * FROM AUTOR";
                    $result=mysqli_query($conexion, $sql);
                    while($mostrar=mysqli_fetch_array($result)){
                        echo 'Nombre autor: '.$mostrar['Nombre'].' '.$mostrar['Apellido1'].' '.$mostrar['Apellido2']. '<br>';
                        }
            ?>";
            document.getElementById('resultado').innerHTML = mensaje;
        }

        function ConsultaLibro(){
            var mensaje="<?php
                $sql="SELECT l.Titulo,l.ISBN,l.Anio, a.Nombre,a.Apellido1,a.Apellido2, e.Nombre_editorial
                FROM libro AS l
                JOIN autor AS a ON l.ID_autor = a.ID_autor
                JOIN editorial AS e ON l.ID_editorial=e.ID_editorial";
                $result=mysqli_query($conexion, $sql);
                while($mostrar=mysqli_fetch_array($result)){
                    echo '|||Titulo: '.$mostrar['Titulo'].' |||ISBN: '.$mostrar['ISBN'].' |||Año: '.$mostrar['Anio']. ' |||Autor: '.$mostrar['Nombre'].' '.$mostrar['Apellido1'].' '.$mostrar['Apellido2'].' |||Editorial: '.$mostrar['Nombre_editorial']. '|||<br>'. '<br>';
                }

            ?>";
            document.getElementById('resultado').innerHTML = mensaje;
        }

        function ConsultaPrestamo(){
            var mensaje="<?php
            $sql="SELECT c.NombreClie, c.Apellido1Clie, c.Apellido2Clie, c.Direccion, p.fecha_salida, p.fecha_entrega, l.Titulo, l.Anio, 
            a.Nombre, a.Apellido1, a.Apellido2, e.Nombre_editorial, co.cantidad
            from prestamo as p
            JOIN cliente AS c ON p.ID_cliente=c.iD_cliente
            JOIN libro As l ON l.ID_libro=p.ID_libro
            JOIN contenido AS co ON co.ID_prestamo=p.ID_prestamo
            JOIN autor AS a ON l.ID_autor=a.ID_autor
            JOIN editorial AS e ON l.ID_editorial=e.ID_editorial";
            $result=mysqli_query($conexion, $sql);
            while($mostrar=mysqli_fetch_array($result)){
                echo '|||Cliente: '. $mostrar['NombreClie']. ' '.$mostrar['Apellido1Clie']. ' '.$mostrar['Apellido2Clie']. '|||Direccion: '.$mostrar['Direccion']. ' |||fecha_salida: '. $mostrar['fecha_salida']. ' |||fecha_entrega: '
                .$mostrar['fecha_entrega']. '|||Titulo del libro: '. $mostrar['Titulo']. '|||Año: '. $mostrar['Anio']. '|||Autor: '. $mostrar['Nombre'].' '.$mostrar['Apellido1'].' '.$mostrar['Apellido2']. '|||Editorial: '.
                $mostrar['Nombre_editorial'].'|||Cantidad de libros prestados: '. $mostrar['cantidad']. '|||<br>'. '<br>';
            }

            ?>";
            document.getElementById('resultado').innerHTML = mensaje;
        }


        function ConsultaCliente(){
            var mensaje="<?php
            $sql="SELECT c.NombreClie, c.Apellido1Clie, c.Apellido2Clie, c.Direccion FROM cliente AS c";
            $result=mysqli_query($conexion, $sql);
            while($mostrar=mysqli_fetch_array($result)){
                echo '|||Nombre Del Cliente: '. $mostrar['NombreClie'].' '. $mostrar['Apellido1Clie'].' '.$mostrar['Apellido2Clie'].' |||Direccion: '.$mostrar['Direccion']. '|||<br>'. '<br>';
            }
            ?>";
            document.getElementById('resultado').innerHTML = mensaje;
        }

        //aqui empiezan los formularios
        function FormularioLibro(){
          
            var formulario = '<form action="procesar_libro.php" method="POST">';
        formulario += '<label for="titulo">Título:</label>';
        formulario += '<input type="text" id="titulo" name="titulo"><br>';
        formulario += '<label for="isbn">ISBN:</label>';
        formulario += '<input type="number" id="isbn" name="isbn"><br>';
        formulario += '<label for="anio">Año:</label>';
        formulario += '<input type="text" id="anio" name="anio"><br>';
        formulario += '<label for="autor">Nombre_Autor:</label>';
        formulario += '<input type="text" id="autor" name="autor"><br>';
        formulario += '<label for="autor">Apellido_paterno_Autor:</label>';
        formulario += '<input type="text" id="Apellido1" name="Apellido1"><br>';
        formulario += '<label for="autor">Apellido_materno_Autor:</label>';
        formulario += '<input type="text" id="Apellido2" name="Apellido2"><br>';
        formulario += '<label for="editorial">Editorial:</label>';
        formulario += '<input type="text" id="editorial" name="editorial"><br>';
        formulario += '<button class="boton2" type="submit">Enviar</button>';
        formulario += '</form>';

         document.getElementById('resultado').innerHTML = formulario;
        
        }

        function FormularioPrestamo(){
            var formulario = '<form action="procesar_prestamo.php" method="POST">';
            formulario += '<label for="nombreLibro">Nombre del libro:</label>';
            formulario += '<input type="text" id="nombreLibro" name="nombreLibro"><br>';
            formulario += '<label for="nombreCliente">Nombre del cliente:</label>';
            formulario += '<input type="text" id="nombreCliente" name="nombreCliente"><br>';
            formulario += '<label for="apellido1Cliente">Apellido paterno del cliente:</label>';
            formulario += '<input type="text" id="apellido1Cliente" name="apellido1Cliente"><br>';
            formulario += '<label for="apellido2Cliente">Apellido materno del cliente:</label>';
            formulario += '<input type="text" id="apellido2Cliente" name="apellido2Cliente"><br>';
            formulario += '<label for="direccion">Dirección:</label>';
            formulario += '<input type="text" id="direccion" name="direccion"><br>';
            formulario += '<label for="cantidadLibros">Cantidad de libros:</label>';
            formulario += '<input type="number" id="cantidadLibros" name="cantidadLibros"><br>';
            formulario += '<label for="fechaSalida">Fecha de salida:</label>';
            formulario += '<input type="date" id="fechaSalida" name="fechaSalida"><br>';
            formulario += '<label for="fechaEntrega">Fecha de entrega:</label>';
            formulario += '<input type="date" id="fechaEntrega" name="fechaEntrega"><br>';
            formulario += '<button class="boton2" type="submit">Enviar</button>';
            formulario += '</form>';

            
            document.getElementById('resultado').innerHTML = formulario;
        }

        function BorrarLibro(){
            var formulario = '<form action="borrar_libro.php" method="POST">';
            formulario += '<label for="nombreLibro">Nombre del libro:</label>';
            formulario += '<input type="text" id="nombreLibro" name="nombreLibro"><br>';
            formulario += '<label for="autor">Nombre_Autor:</label>';
            formulario += '<input type="text" id="autor" name="autor"><br>';
            formulario += '<label for="autor">Apellido_paterno_Autor:</label>';
            formulario += '<input type="text" id="Apellido1" name="Apellido1"><br>';
            formulario += '<label for="autor">Apellido_materno_Autor:</label>';
            formulario += '<input type="text" id="Apellido2" name="Apellido2"><br>';
            formulario += '<label for="editorial">Editorial:</label>';
            formulario += '<input type="text" id="editorial" name="editorial"><br>';
            formulario += '<button class="boton2" type="submit">Enviar</button>';
            formulario += '</form>';


            document.getElementById('resultado').innerHTML = formulario;
        }

        function BorrarPrestamo() {
        var formulario = '<form action="borrar_prestamo.php" method="POST">';
        formulario += '<label for="nombreCliente">Nombre del cliente:</label>';
        formulario += '<input type="text" id="nombreCliente" name="nombreCliente"><br>';
        formulario += '<label for="Apellido1">Apellido paterno del cliente:</label>';
        formulario += '<input type="text" id="Apellido1" name="Apellido1"><br>';
        formulario += '<label for="Apellido2">Apellido materno del cliente:</label>';
        formulario += '<input type="text" id="Apellido2" name="Apellido2"><br>';
        formulario += '<label for="tituloLibro">Título del libro:</label>';
        formulario += '<input type="text" id="tituloLibro" name="tituloLibro"><br>';
        formulario += '<button class="boton2" type="submit">Enviar</button>';
        formulario += '</form>';

  document.getElementById('resultado').innerHTML = formulario;
}




        

</script>



</body>
</html>
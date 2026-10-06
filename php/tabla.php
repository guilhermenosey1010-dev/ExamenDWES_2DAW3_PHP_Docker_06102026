<?php
include 'conexion.php';
?>
<html>
    <head>
        <title>Examen de Desarrollo web en entorno servidor</title>
        <link rel="icon" type="image/png" sizes="32x32" href="../imagenes/favicon.jpeg">
        <link rel="stylesheet" type="text/css" href="../estilos/estilos.css">

    </head>
    <body>
        <h1>Centro de Ayuda al Empleo</h1>
        <h2>    
            <?php
                $tipo = "Soldadura";
                if ($_REQUEST['tipo'] == 'informatica'){
                    $tipo = 'Informática';
                } elseif ($_REQUEST['tipo'] == 'socio'){
                    $tipo = "Asistencia Sociosanitaria";
                }
                echo "Solicitudes de $tipo";
            ?>
        </h2>

        
        <?php 
        // Aquí tenéis que crear la tabla de solicitantes de ese tipo
            
        if (

    isset($_POST['nombre']) &&
    isset($_POST['apellidos']) &&
    isset($_POST['dni']) &&
    isset($_POST['f_nac']) &&
    isset($_POST['tlf']) &&
    isset($_POST['email']) &&
    isset($_POST['tipo']) &&
    isset($_POST['jornadaParcial'])
) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $f_nac = $_POST['f_nac'];
    $tlf = $_POST['tlf'];
    $email = $_POST['email'];
    $profesion = $_POST['tipo'];
    $jornadaParcial = $_POST['jornadaParcial'];
    $idiomas = isset($_POST['idiomas']) ? implode(',', $_POST['idiomas']) : '';

    echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
    echo "Apellidos: " . htmlspecialchars($apellidos) . "<br>";
    echo "DNI: " . htmlspecialchars($dni) . "<br>";
    echo "Fecha de nacimiento: " . htmlspecialchars($f_nac) . "<br>";
    echo "Teléfono: " . htmlspecialchars($tlf) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Jornada parcial: " . htmlspecialchars($jornadaParcial) . "<br>";
    echo "Idiomas: " . htmlspecialchars($idiomas) . "<br>";

    $sql = "INSERT INTO solicitud (nombre, apellidos, dni, f_nac, tlf, email, profesion, jornadaParcial, idiomas)
            VALUES ('$nombre', '$apellidos', '$dni', '$f_nac', '$tlf', '$email', '$profesion', '$jornadaParcial', '$idiomas')";
    mysqli_query($conexion, $sql) or die("Problemas al guardar los datos");
    echo "Datos guardados";
} else {
    echo "No se han recibido todos los datos";
}
?>
        
        <button onclick="location.href='../html/index.html'">Volver al formulario</button>
    </body>
</html>
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

        //sirve para que al dar a cada link en el html se cambie al apartado que seleccionaste
            <?php
                $profesion = $_POST['tipo'] ?? $_GET['tipo'] ?? 'soldadura';

                if ($profesion == 'informatica') {
                    $tipo = 'Informática';
                } elseif ($profesion == 'socio' || $profesion == 'asistencia sociosanitaria') {
                    $profesion = 'asistencia sociosanitaria';
                    $tipo = 'Asistencia Sociosanitaria';
                } else {
                    $profesion = 'soldadura';
                    $tipo = 'Soldadura';
                }
                echo "Solicitudes de $tipo";
            ?>
        </h2>

        
        <?php 
        // Aquí tenéis que crear la tabla de solicitantes de ese tipo
    //comprobar que los datos se enviaron a traves de POST
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
    //Pasar los datos del formulario a variables
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $f_nac = $_POST['f_nac'];
    $tlf = $_POST['tlf'];
    $email = $_POST['email'];
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
//guardar en una variable lo que voy a ejecutar en la base de datos en $sql
    $sql = "INSERT INTO solicitud (nombre, apellidos, dni, f_nac, tlf, email, profesion, jornadaParcial, idiomas)
            VALUES ('$nombre', '$apellidos', '$dni', '$f_nac', '$tlf', '$email', '$profesion', '$jornadaParcial', '$idiomas')";
//ejecucion de lo anterior
    mysqli_query($conexion, $sql) or die("Problemas al guardar los datos");
    echo "Datos guardados";
//gentionar formularios incompletos
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "No se han recibido todos los datos";
    }
}
//guardar en una variable la fila que voy a printear en pantalla por '$profesion'
$registros = mysqli_query($conexion, "SELECT id, nombre, apellidos, dni, f_nac, tlf, email, profesion, jornadaParcial, idiomas FROM solicitud WHERE profesion = '$profesion'")
    or die("Problemas al consultar las solicitudes");
//creacion de la tabla donde se enseñara esa fila
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>DNI</th><th>Fecha de nacimiento</th><th>Teléfono</th><th>Email</th><th>Profesión</th><th>Jornada parcial</th><th>Idiomas</th></tr>";
while ($fila = mysqli_fetch_assoc($registros)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($fila['id']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['apellidos']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['dni']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['f_nac']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['tlf']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['profesion']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['jornadaParcial']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['idiomas']) . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
        
        <button onclick="location.href='../html/index.html'">Volver al formulario</button>
    </body>
</html>
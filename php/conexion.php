<?php
$conexion = mysqli_connect("localhost", "guilherme", "", "cae") or die("Problemas con la conexión");

$registros = mysqli_query($conexion, "select id, nombre, apellidos, dni, f_nac, tlf, email, profesion, jornadaParcial, idiomas from solicitud") or die("Problemas con la conexión");
?>
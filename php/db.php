<?php
// Configuración de la base de datos REAL en InfinityFree
$host = "sql213.infinityfree.com"; // MySQL Hostname 
$user = "if0_41117161";            // MySQL Username 
$password = "nYP4jxkIu4rwy";       // Tu password de hosting
$dbname = "if0_41117161_contact_form_db"; // Database Name 

// Crear la conexión
$conn = mysqli_connect($host, $user, $password, $dbname);

// Validar conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
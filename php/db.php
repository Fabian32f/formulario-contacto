<?php
// Configuración de la base de datos
$host = "127.0.0.1";
$user = "root";
$password = ""; // Vacío por defecto en Laragon
$dbname = "contact_form_db";

// Crear la conexión con MySQL
$conn = mysqli_connect($host, $user, $password, $dbname);

// Validar si la conexión falló (Tarea del Backend 3)
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
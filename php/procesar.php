<?php
// Incluimos la conexión que está en la misma carpeta
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recopilación de datos (Usamos real_escape_string por seguridad)
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tipo_consulta = mysqli_real_escape_string($conn, $_POST['tipo_consulta']);
    $mensaje = mysqli_real_escape_string($conn, $_POST['mensaje']);
    $consentimiento = isset($_POST['consentimiento']) ? 1 : 0;

    // Validación de datos en el servidor (Requisito del desafío)
    if (empty($nombre) || empty($apellido) || empty($email) || empty($mensaje) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Si algo está mal, regresamos con un error
        header("Location: ../index.php?error=1");
        exit();
    }

    // Paso 10: Consulta SQL para insertar los datos
    $sql = "INSERT INTO envios (nombre, apellido, email, tipo_consulta, mensaje, consentimiento) 
            VALUES ('$nombre', '$apellido', '$email', '$tipo_consulta', '$mensaje', '$consentimiento')";

    if (mysqli_query($conn, $sql)) {
        // Éxito: Regresamos al index con una señal de éxito
        header("Location: ../index.php?success=1");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
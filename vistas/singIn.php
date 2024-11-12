<?php
// Incluimos el archivo de conexión a la BD
include 'conexion.php';

// Iniciamos la sesión para manejar el estado del usuario y el token
session_start();

// Generar un token CSRF si no existe en la sesión para evitar ataques
if (empty($_SESSION['token'])) {
    // Generamos un token de 32 bytes
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

// Datos del proceso de envío al espacio
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificamos el token CSRF
    if (!hash_equals($_SESSION['token'], $_POST['csrf_token'])) {
        // Detenemos la ejecución si el token es distinto 
        die('Token CSRF inválido');
    }

    // Escapamos los inputs desde el formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $correo = htmlspecialchars($_POST['correo']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Cifrar la contraseña
    $rol = $_POST['rol'];

    // Validar que el correo tenga un formato válido
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Si el correo es inválido, mostrar un alerta y volver a intentarlo
        echo "<script>alert('El correo es inválido.');
            window.location.href='register.php';</script>";
        exit();
    }

    // Verificar si el correo ya existe
    $check_email = $conn->prepare("SELECT correo FROM usuarios WHERE correo = ?");
    $check_email->bind_param("s", $correo);
    $check_email->execute();
    $check_email->store_result();

    // Si el correo ya existe, mostrar un mensaje
    if ($check_email->num_rows > 0) {
        // Enviar mensaje de correo ya existente
        echo "<script>alert('El correo ya existe.'); window.location.href='register.php';</script>";

    } else {
        // Insertar el nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $correo, $password, $rol);

        // Verificar si la inserción fue exitosa
        if ($stmt->execute()) {
            // Enviar un mensaje de registro exitoso
            echo "<script>alert('Registro exitoso.'); window.location.href='login.php';</script>";

        } else {
            // Si ocurrió un error al registrar, mostrar el siguiente mensaje 
            echo "<script>alert('Error al registrar el usuario.'); window.location.href='register.php';</script>";
        }

        // Cerrar la variable $stmt después de ejecutarla
        $stmt->close();
    }

    $check_email->close(); // Cerrar la declaración del check_email
    $conn->close(); // Cerrar la conexión a la BD
}
?>
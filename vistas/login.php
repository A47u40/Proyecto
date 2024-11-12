
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styleLogin.css">
    <script defer src="../java/main.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <!-- Sign Up -->
        <?php

        $action = $_POST['action'];

        include 'conexion.php';

            // Iniciamos la sesión para manejar el estado del usuario y el token
            session_start();

            // Generar un token CSRF si no existe en la sesión para evitar ataques
            if (empty($_SESSION['token'])) {
                // Generamos un token de 32 bytes
                $_SESSION['token'] = bin2hex(random_bytes(32));
            }

        if($action == 'Registrar'){
            // Incluimos el archivo de conexión a la BD
            

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
                    echo "<script>alert('El correo es inválido.');window.location.href='login.php';</script>";
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
                    echo "<script>alert('El correo ya existe.'); window.location.href='login.php';</script>";

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
                        echo "<script>alert('Error al registrar el usuario.'); window.location.href='login.php';</script>";
                    }

                    // Cerrar la variable $stmt después de ejecutarla
                    $stmt->close();
                }

                $check_email->close(); // Cerrar la declaración del check_email
                $conn->close(); // Cerrar la conexión a la BD
            }
        }else{
            
            // Usar METHOD_REQUEST para hacer peticiones al servidor
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Escapamos la entrada de los inputs para evitar ataques XSS
                $correo = htmlspecialchars($_POST['correo']);
                // Recibimos la contraseña sin cifrar
                $password = $_POST['password'];

                // Preparamos la consulta para verificar si el correo existe en la bd
                $stmt = $conn->prepare("SELECT id, nombre, password, rol FROM usuarios WHERE correo = ?");
                $stmt->bind_param("s",  $correo); // Vinculamos el parametro de correo
                $stmt->execute();

                // Vinculamos los resultados a variables
                $stmt->bind_result($id, $nombre, $hash, $rol);
                $stmt->fetch();

                // Verificar si la contraseña ingresada es correcta a la cifrada en la bd
                if ($hash && password_verify($password, $hash)) {
                    // Si la contraseña es correcta, almacenamos el valor en la $_SESSION
                    $_SESSION['id'] = $id; // Almacenar el id del usuario
                    $_SESSION['username'] = $nombre; // Almacenar el nombre del usuario
                    $_SESSION['rol'] = $rol; // Almacenar el rol del usuario
                    if($rol == "Cliente"){
                        header("Location: visUser.php");
                    }else{
                    // Redirigir al dashboard
                    header("Location: panelControl.php");
                    }
                    exit;
                }else {
                    // Si el correo o la contraseña son incorrectos, mostrar una alerta
                    echo "<script>alert('Correo o contraseña incorrectos.'); window.location.href='login.php';</script>";
                }

                // Cerrar la variable $stmt
                $stmt->close();
                // Cerrar la conexión a la bd
                $conn->close();
            }
        }
        
?>
        <div class="container__form container--signup" id="signupForm">
            <form action="login.php" method="post" class="form" id="form1">
                <h2 class="form__title">Registrar</h2>
                <input name="nombre" type="text" placeholder="Nombre" class="input" required />
                <!-- <input name="apellidoM" type="text" placeholder="Apellido Materno" class="input" required />
                <input name="apellidoP" type="text" placeholder="Apellido Paterno" class="input" required />
                <input name="nomUs" type="text" placeholder="Nombre de Usuario" class="input" required />-->
                <!-- <input name="numTel" type="number" maxlength="10" placeholder="Numero Telefonico" class="input" required />  -->
                <input name="correo" type="email" placeholder="Correo Electronico" class="input" required />
                <input name="password" type="password" placeholder="Contraseña" class="input" required /> 
                Rol:
                <select name="rol" required>
                    <option value="Admin">Admin</option>
                    <option value="Empleado">Empleado</option>
                    <option value="Cliente">Cliente</option>
                    <option value="Secretaria_compras">Secretaria de compras</option>
                    <option value="Secretaria_ventas">Secretaria de ventas</option>
                    <option value="Tecnico">Tecnico</option>
                </select> 
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>">
                <input type="submit" class="btn" value="Registrar"  name="action" />
            </form>
        </div>

        <!-- Sign In -->
        <div class="container__form container--signin" id="signinForm">
            <form action="login.php" method="post" class="form" id="form2">
                <h2 class="form__title">Iniciar sesion</h2>
                <input name="correo" type="text" placeholder="Correo electronico o Nombre de usuario" class="input" required />
                <input name="password" type="password" placeholder="contraseña" class="input" required />
                <a href="#" class="link">No me acuerdo de mi contraseña</a>

                <input class="btn" name="action" type="submit" value="Iniciar sesion">
            </form>
        </div> 

        <!-- Botones de navegación -->
        
    </div>

    <button class="btn" id="signIn">Iniciar sesion</button>
    <button class="btn" id="signUp">Registrar</button>
    <a class="btn" href="../index.html">Pagina del Inicio</a>
</body>
</html>

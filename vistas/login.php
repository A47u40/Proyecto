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
        <div class="container__form container--signup" id="signupForm">
            <form action="sinUp.php" method="post" class="form" id="form1">
                <h2 class="form__title">Registrar</h2>
                <input name="nombre" type="text" placeholder="Nombre" class="input" required />
                <input name="apellidoM" type="text" placeholder="Apellido Materno" class="input" required />
                <input name="apellidoP" type="text" placeholder="Apellido Paterno" class="input" required />
                <input name="nomUs" type="text" placeholder="Nombre de Usuario" class="input" required />
                <input name="numTel" type="number" maxlength="10" placeholder="Numero Telefonico" class="input" required />
                <input name="correoElectronico" type="email" placeholder="Correo Electronico" class="input" required />
                <input name="contraseña" type="password" placeholder="Contraseña" class="input" required />  
                <input type="submit" class="btn" value="Registrar"  name="register" />
            </form>
        </div>

        <!-- Sign In -->
         <div class="container__form container--signin" id="signinForm">
            <form action="singin.php" method="post" class="form" id="form2">
                <h2 class="form__title">Iniciar sesion</h2>
                <input name="nomUsLogin" type="text" placeholder="Correo electronico o Nombre de usuario" class="input" required />
                <input name="contraseña" type="password" placeholder="contraseña" class="input" required />
                <a href="#" class="link">No me acuerdo de mi contraseña</a>
                <input class="btn" name="login" type="submit" value="Iniciar sesion">
            </form>
        </div> 

        <!-- Botones de navegación -->
        
    </div>

    <button class="btn" id="signIn">Iniciar sesion</button>
    <button class="btn" id="signUp">Registrar</button>
    <a class="btn" href="../index.html">Pagina del Inicio</a>
</body>
</html>

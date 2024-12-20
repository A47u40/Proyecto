<?php
// incluir la conexion a la red
include 'conexion.php';

//iniciar sesion de usuario
session_start();

//verificar si el usuario ha iniciado sesion y si no redirigirlo a login
if (!isset($_SESSION['rol'])) {
    header('Location: login.php');
    exit;
}

//escapar el valor de rol para prevenir ataques XSS
$rol = htmlspecialchars($_SESSION['rol']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/cards.css">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clima Polar del Pacifico</title>
</head>
<body>
    <header>
        <div class="brand">
            <span class="logo"><img class="logoOsoPolar" src="../img/logo2.png" alt=""></span>
            <h3>Clima Polar del Pacifico</h3>
        </div>

        <ul>
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">¿Quienes somos?</a>
            </li>
            <li>
                <a href="#">¿Que Ofrecemos?</a>
            </li>
            <li>
                <a href="#">Contacto</a>
            </li>
            <li>
                <a href="panelControl.php">Panel de Control</a>
            </li>
            <li>
            <a href="logout.php" id="logout-btn">Salir <i class="fas fa-sign-out-alt"></i></a>
            </li>
            
        </ul>


        </div> 


    </header>

    <div class="portada">

        <h1 class="textWhite" >CLIMA POLAR DEL PACIFICO</h1>
        <h3 class="textWhite" >Domina el clima, controla tu confort.</h3>
        
    </div>

    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img class="logo" src="../img/logo2.png" alt="Logo de SLee Dw">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, ipsa?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio, ipsa?</p>
            </div>
            <div class="box">
                <h2>SIGUENOS</h2>
                <div class="red-social">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-youtube"></a>
                </div>
            </div>
        </div>
        <div class="grupo-2">
            <small>&copy; 2024 <b>Clima Polar del Pacifico</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>

    
    
</body>

</html>
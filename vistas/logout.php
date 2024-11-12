<?php
//Iniciar la sesion para destruirla
session_start();

//Destruir todas las variables de sesion
session_destroy();

//redirigir al usurio a la pagina de login despues de cerrarla
header('Location: login.php');

//Finalizar el script para que no se ejecute mas codigo
exit;

?>

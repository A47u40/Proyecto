<?php

include "conexion.php";


// Inicio De Sesion --------------------------------------------------------------------------------------------//

if(isset($_POST['login'])){
    $nomUs = trim($_POST["nomUsLogin"]);
    $contraseña = trim($_POST["contraseña"]);

    $consultaClientesNombreUs = "SELECT nombre FROM cliente WHERE nombre_usuario = '$nomUs' AND contraseña = '$contraseña'";
        $consultaClientesEmail = "SELECT nombre FROM cliente WHERE correo_electronico = '$nomUs' AND contraseña = '$contraseña'";
        $consultaTrabajadoresNombreUs = "SELECT id_trabajador fROM  trabajadores WHERE nombre_usuario = '$nomUs' AND contraseña = '$contraseña'";
        $consultaTrabajadoresEmail = "SELECT nombre fROM trabajadores WHERE correo_electronico = '$nomUs' AND contraseña = '$contraseña'";

        $resultadoConsultaClientesNombreUs = mysqli_query($conex,$consultaClientesNombreUs);
        $resultadoConsultaClientesEmail = mysqli_query($conex,$consultaClientesEmail);
        $resultadoConsultaTrabajadoresNombreUs = mysqli_query($conex,$consultaTrabajadoresNombreUs);
        $resultadoConsultaTrabajadoresEmail = mysqli_query($conex,$consultaTrabajadoresEmail);



        if(mysqli_num_rows($resultadoConsultaClientesNombreUs) == 1 || mysqli_num_rows($resultadoConsultaClientesEmail) == 1  ){
           
            header("location:visUser.php");
            

        }elseif(mysqli_num_rows($resultadoConsultaTrabajadoresNombreUs)  == 1 || mysqli_num_rows($resultadoConsultaTrabajadoresEmail) == 1){

            header("location:panelControl.php");
            
        }else{

            echo "
        <h1>Nombre de usuario y contraseña no validos favor de intentar nuevamente</h1>
                <a href='login.php'>Regresar</a>
    
         ";

        }

}



?>
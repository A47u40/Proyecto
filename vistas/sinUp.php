<?php 

include("conexion.php");

if (isset($_POST['register'])) {

	    $name = trim($_POST['nombre']);
        $apellidoM = trim($_POST['apellidoM']);
        $apellidoP = trim($_POST['apellidoP']);
        $correoElectronico = trim($_POST['correoElectronico']);
        $nomUs = trim($_POST['nomUs']);
        $numTel = trim($_POST['numTel']);
        $contraseña = trim($_POST['contraseña']);

        // $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);
        $consultaClientesNombreUs = "SELECT nombre FROM cliente WHERE nombre_usuario = '$nomUs'";
        $consultaClientesEmail = "SELECT nombre FROM cliente WHERE correo_electronico = '$correoElectronico'";
        $consultaTrabajadoresNombreUs = "SELECT id_trabajador fROM  trabajadores WHERE nombre_usuario = '$nomUs'";
        $consultaTrabajadoresEmail = "SELECT nombre fROM trabajadores WHERE correo_electronico = '$correoElectronico'";

        $resultadoConsultaClientesNombreUs = mysqli_query($conex,$consultaClientesNombreUs);
        $resultadoConsultaClientesEmail = mysqli_query($conex,$consultaClientesEmail);
        $resultadoConsultaTrabajadoresNombreUs = mysqli_query($conex,$consultaTrabajadoresNombreUs);
        $resultadoConsultaTrabajadoresEmail = mysqli_query($conex,$consultaTrabajadoresEmail);    

        
        if(mysqli_num_rows($resultadoConsultaClientesNombreUs) >= 1 || mysqli_num_rows($resultadoConsultaClientesEmail) >=1  ){
            echo "<script> alert('El nombre de Usuario ya a sido utilizado favor de utilizar uno que no este existente!!');</script>
            
            <a href='login.php'>Regresar</a>";

            

        }elseif(mysqli_num_rows($resultadoConsultaTrabajadoresNombreUs) >= 1 || mysqli_num_rows($resultadoConsultaTrabajadoresEmail) >= 1){

            echo "<script> alert('El correo electronico ya a sido utilizado favor de utilizar uno que no este existente!!');</script>
            
            <a href='login.php'>Regresar</a>";


        }else{

            $registrarUsuario = "INSERT INTO cliente (nombre, apellidoM, apellidoP, correo_electronico, nombre_usuario, numero_telefonico, contraseña) VALUES ('$name', '$apellidoM', '$apellidoP', '$correoElectronico', '$nomUs', '$numTel', '$contraseña')";
	        $resultado = mysqli_query($conex,$registrarUsuario);
	        if ($resultado) {

                echo "<script> alert('Su Registro a concluido Correctamente Favor de Iniciar sesion');</script>";
                
                header("location:login.php");

	    	
	        } else {
                echo "<script> alert('HUbo un error al enviar los datos!!');</script>
                
                
                <a href='login.php'>Regresar</a>";
	    	
	        }

        }
        


	    
}

?>
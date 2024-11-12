<?php
//Configuracion de variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "awos2_2024";

//crea la conexion
$conn = new mysqli($servername, $username, $password,$dbname);

// verificar la conexion
if($conn->connect_error){
    die("Conexion fallidas: " .$conn->connect_error);
}
?>
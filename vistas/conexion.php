<?php
$servername = "ti32.com";
$database = "u297692415_proyecto_renat";
$username = "u297692415_arturo";
$password = "QUIQUE?si5002";
// Create connection
$conex = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conex) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
mysqli_close($conex);
?>
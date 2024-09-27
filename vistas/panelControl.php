<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/panelControl.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="app_container">
  
  <div class="side-nav">
   
    <ul class="nav-links">
        <li>
          
          <!-- <a href="#" id="home">home</a>
        </li>
        <li> -->
          
          <a href="#" id="clientes">clientes</a>
        </li>

        <li>
            <a href="../index.html">Cerrar secion</a>
        </li>
        <!-- <li>
          
          <a href="#" id="trabajadores" >trabajadores</a>
        </li>
        <li>
          
          <a href="#" id="trabajadores" >compras</a>
        </li>
        <li>
          
          <a href="#" id="ventas">ventas</a>
        </li> -->
      </ul>
      
      <div class="storage">
        <span></span>
      </div>
  </div>
  
  
  <table id="tablaClientes">
  
  <thead>
    <tr>
      <th class="second">nombre</th>
      <th class="third">nombre de usuario</th>
      <th class="fourth">email</th>
      <th class="fifth">telefono</th>

    </tr>
  </thead>
  
  <?php

  $inc = include("conexion.php");

  if ($inc) {
	$consulta = "SELECT id_cliente, nombre, nombre_usuario, correo_electronico, numero_telefonico FROM cliente";
	$resultado = mysqli_query($conex,$consulta);
	if ($resultado) {
		while ($row = $resultado->fetch_array()) {
        $id = $row['id_cliente'];
	    $nombre = $row['nombre'];
	    $nomUs = $row['nombre_usuario'];
	    $email = $row['correo_electronico'];
	    $telefono = $row['numero_telefonico'];

  ?>
      
    <tr>
      <td class="second"><?php echo $nombre; ?></td>
      <td class="third"><?php echo $nomUs; ?></td>
      <td class="fourth"><?php echo $email; ?></td>
      <td class="fifth"><?php echo $telefono; ?></td>
      <td><a href="modificarUsuario.php" id="<?=$row['id_cliente'];?>"></a></td>
      
    </tr>
    <?php

        }
    }
  }
  ?>
  </tbody>

</table>
</div>



    
</body>
</html>

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
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" 
        integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="../css/styles2.css">
        <title>Dashboard / Clima polar</title>
    </head>
    <body>
        <div class="sidebar">
            <!-- Titulo del sistema -->
            <h4><a href="#" style="text-decoration: none; color: inherit; padding: 0;">Climar polar</a></h4>
            <hr>
            <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
            <!-- Menu basado en roles de usuario -->
            <?php if ($rol === 'Admin') : ?>
            <a class="active"><i class="fas fa-user-circle"></i> Cuentas</a>
            <a href="#"> <i class="fas fa-user"></i> Usuarios</a>

            <a class="active"> Comprar y venta</a>
            <a href="#"> <i class="fas fa-money-bill-wave"></i> Pagos</a>
            <a href="#"> <i class="fas fa-store"></i> Ventas</a>
            <a href="#"> <i class="fas fa-shopping-basket"></i> Compras</a>

            <a class="active"> Catalogar</a>
            <a href="#"> <i class="fas fa-fan"></i> Productos</a>
            <a href="#"> <i class="fas fa-th-list"></i> Categoria</a>

            <a class="active">Pedido Y Envio</a>
            <a href="#"> <i class="fas fa-truck"></i> Transporte</a>
            <a href="#"> <i class="fas fa-users"></i> Clientes</a>
            <a href="#"> <i class="fas fa-cash-register"></i> Pedidos</a>

            <!-- Rol del empleado -->
            <?php elseif ($rol === 'Empleado') : ?>
            <a class="active"> Catalogar</a>
            <a href="#"><i class="fas fa-box"></i> Productos</a>
            <a href="#"><i class="fas fa-list"></i> Categoría</a>

            <a class="active">Pedido Y Envio</a>
            <a href="#"><i class="fas fa-truck"></i> Transporte</a>
            <a href="#"><i class="fas fa-user-friends"></i> Clientes</a>
            <a href="#"><i class="fas fa-box-open"></i> Pedidos</a>

            <!-- Rol de secretaria de compra -->
            <?php elseif ($rol === 'Secretaria_compras') : ?>
            <a class="active"> Comprar y venta</a>
            <a href="#"> <i class="fas fa-money-bill-wave"></i> Pagos</a>
            <a href="#"> <i class="fas fa-store"></i> Ventas</a>
            <a href="#"> <i class="fas fa-shopping-basket"></i> Compras</a>

            <a class="active"> Catalogar</a>
            <a href="#"> <i class="fas fa-fan"></i> Productos</a>
            <a href="#"> <i class="fas fa-th-list"></i> Categoria</a>
            
            <a class="active">Pedido Y Envio</a>
            <a href="#"> <i class="fas fa-truck"></i> Transporte</a>
            <a href="#"> <i class="fas fa-users"></i> Clientes</a>
            <a href="#"> <i class="fas fa-cash-register"></i> Pedidos</a>
            <!-- Rol de secretaria de venta -->
            <?php elseif ($rol === 'Secretaria_ventas') : ?>
            <a class="active"> Comprar y venta</a>
            <a href="#"> <i class="fas fa-money-bill-wave"></i> Pagos</a>
            <a href="#"> <i class="fas fa-store"></i> Ventas</a>
            <a href="#"> <i class="fas fa-shopping-basket"></i> Compras</a>

            <a class="active">Pedido Y Envio</a>
            <a href="#"> <i class="fas fa-truck"></i> Transporte</a>
            <a href="#"> <i class="fas fa-users"></i> Clientes</a>
            <a href="#"> <i class="fas fa-cash-register"></i> Pedidos</a>
            <!-- Rol de tecnico -->
            <?php elseif ($rol === 'Tecnico') : ?>
            <a class="active">Pedido Y Envio</a>
            <a href="#"> <i class="fas fa-users"></i> Clientes</a>
            <!-- Rol del cliente -->
            <?php elseif ($rol === 'Cliente') : ?>
            <a href="#"><i class="fas fa-box-open"></i> Pedido</a>
            <?php endif; ?>
            <hr>
            <!-- Enlace para cerrar sesion -->
            <a href="logout.php" id="logout-btn">Salir <i class="fas fa-sign-out-alt"></i></a>
        </div>
        <div class="main-content">
            <div class="d-flex justify-content-between">
                <h2>Dashboard</h2>
                <!-- Mostrar el nombre del usuario y un saludo -->
                <p class="text-end">Hola, Bienvenido: <strong> 
                    <?php echo $_SESSION['username']; ?></strong>
                </p>
            </div>
            <hr>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                //conexion a la bd
                include 'conexion.php';
                //obtener el rol del usuario y el id de la sesion
                $rol = $_SESSION['rol'];
                $id_usuario = $_SESSION['id'];

                // verificar si el rol admin o cliente
                if ($rol == 'Admin') { 
                    // Si el rol es Admin, ver todos los usuarios
                    $query = "SELECT * FROM usuarios";
                } elseif ($rol == 'Cliente' || $rol == 'Secretaria_compras' || $rol == 'Secretaria_ventas' || $rol == 'Tecnico') {
                    // Si el rol es Cliente u otro, solo mostrar su propio registro
                    $query = "SELECT * FROM usuarios WHERE id = '$id_usuario'";
                } else {
                    // El rol de empleado puede ver a otros empleados
                    $query = "SELECT * FROM usuarios WHERE rol = '$rol'";
                }
                

                //ejecutar la consulta
                $result = $conn->query($query);

                //Verificar si hay resultados
                if ($result->num_rows > 0) {
                    //mostrar los resultados de los usuarios
                    while ($row = $result->fetch_array()) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['correo']; ?></td>
                    <td><?php echo $row['rol']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                </tr>
                <?php
                    }
                } else {
                    //si no hay registros, mostrar un mensaje
                    echo "<h2>No se encontraron registros</h2>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
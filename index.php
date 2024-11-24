<!------------------------------ funcion para inicio de seccion ---------------------------------->
<?php
// conexion con la base de datos
include("./php/conexion.php");

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Preparar consulta para evitar inyección SQL
    $query = $conexion->prepare("SELECT * FROM user WHERE usuario = ? AND contrasena = ?");
    $query->bind_param("ss", $usuario, $contrasena);

    // Ejecutar la consulta
    $query->execute();
    $resultado = $query->get_result();

    // Verificar si existe el usuario
    if ($resultado->num_rows > 0) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        // Usuario y contraseña correctos, redirigir a prestamo.php
        header('Location: ./php/principal.php');
        exit();
    } else {
        echo "Usuario o contraseña incorrectos";
    }

    // Cerrar consulta
    $query->close();
}

// Cerrar conexión
$conexion->close();
?>
<!---------------------------------------- INICIO DEL HTML -------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<header class="navbar"></header>
<!-- formulario de inicio secion -->
<form action="" method="post">
    <input type="text" name="usuario" placeholder="Usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <button type="submit" class="button">Ingresar</button>
</form>

<!----------------------------------- funcion para la barra de estatus ----------------------------------------->
<?php
// Obtener el nombre del servidor (nombre de la computadora)
$server_name = gethostname();

// Obtener la IP del servidor (dirección IP de la computadora)
$server_ip = $_SERVER['SERVER_ADDR'];

// Aquí asumimos que la conexión está activa si llegamos hasta este punto
$connection_status = "Conexión activa"; // Puedes cambiar este valor según tu lógica de conexión
?>
<!------------------- barra de estatus pero en html y solo se hace llamar la funcion --------------------------->
<footer class="status-bar">
    <div class="status-item">Server Name: <span><?php echo $server_name; ?></span></div>
    <div class="status-item">Estatus de la Conexión: <span><?php echo $connection_status; ?></span></div>
    <div class="status-item">IP: <span><?php echo $server_ip; ?></span></div>
</footer>
</body>
</html>

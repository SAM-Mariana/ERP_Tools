<!--------------------------- PARTE DEL LOGUEADO CON EL USUARIO --------------------------------->
<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir a la página de inicio de sesión
    header('Location: index.php');
    exit();
}
?>

<!---------------------------------------- INICIO DEL HTML -------------------------------------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Entrega</title>
    <link rel="stylesheet" href="../css/ticket.css">
</head>
<!-------------------------------------- barra de navegacio -------------------------------------->
<header class="navbar">
<!-- el echo es para imprimir en pantalla y luego se jala lo que es el nombre del usuario -->
    <div class="navbar-item">Usuario: <span id="username"><?php echo $_SESSION['usuario']; ?></span></div>
<!-- es para poder optener la fecha el cual se crea un funcion llamada $current_date despues se hace llamar para imprimir  -->    
<?php
// Obtener la fecha actual
$current_date = date("l, j F Y"); // Esto te dará la fecha en formato: "Monday, 18 November 2024"
?>
<div class="navbar-item"><span><?php echo $current_date; ?></span></div>
    </header>
<!----------------------------------------- TICKET ------------------------------------------------>
<body>
    <?php
    // Captura los datos enviados por GET
    $empleado = $_GET['empleado'] ?? '';
    $folio = $_GET['folio'] ?? '';
    $date_prestamo = $_GET['date_prestamo'] ?? '';
    $date_entrega = $_GET['date_entrega'] ?? '';
    $entrega = $_GET['entrega'] ?? '';
    $sku = $_GET['sku'] ?? '';
    $tool = $_GET['tool'] ?? '';
    $cantidad = $_GET['cantidad'] ?? '';
    ?>
    <section>
    <div class="image-bar">
        <a href="./prestamo.php"> <img src="../imagen/refrescar.png" alt="refescar" class="botones"></a>
    </div>
<!-- estructura del ticket-->
    <div class="ticket">
        <img src="../imagen/logo.png">
        <h1>Ticket de Entrega</h1>
        <p><strong>Empleado:</strong> <?php echo htmlspecialchars($empleado); ?></p>
        <p><strong>Folio:</strong> <?php echo htmlspecialchars($folio); ?></p>
        <p><strong>Fecha de Préstamo:</strong> <?php echo htmlspecialchars($date_prestamo); ?></p>
        <p><strong>Fecha de Entrega:</strong> <?php echo htmlspecialchars($date_entrega); ?></p>
        <p><strong>Entregado:</strong> <?php echo htmlspecialchars($entrega); ?></p>
        <p><strong>SKU:</strong> <?php echo htmlspecialchars($sku); ?></p>
        <p><strong>Herramienta:</strong> <?php echo htmlspecialchars($tool); ?></p>
        <p><strong>Cantidad:</strong> <?php echo htmlspecialchars($cantidad); ?></p>
        <a href="#" class="btn-print" onclick="window.print()">Imprimir Ticket</a>
    </div>
    <section>
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






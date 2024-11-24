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
    <title>pri</title>
    <link rel="stylesheet" href="../css/principal.css">
</head>
<body>
    
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

<!---------------------------------------- lado izquierdo --------------------------------------->       
    <section class="two-columns">
        <div class="left-column">
            <div class="container">
                <img src="../imagen/barraMensaje.png" alt="Mensaje" class="rectangle">
                <img src="../imagen/foto2.png" alt="Foto Usuario" class="circle center-circle">
                <img src="../imagen/logoMazdaMen.png" alt="Logo" class="circle offset-circle">
            </div>
        </div>
        <img src="../imagen/mensaje.png" alt="mensaje" class="mensaje">
        <div class="right-column">
            <div class="container-imag">
                <div class="image-gallery">
                    <img src="../imagen/inventario.png" alt="Imagen 3">
                    <img src="../imagen/sku.png" alt="Imagen 2">
                    <a href="prestamo.php"><img src="../imagen/prestamo.png" alt="Imagen 1"></a>
                    <img src="../imagen/busqueda.png" alt="Imagen 6">
                    <img src="../imagen/bajoStock.png" alt="Imagen 5">
                    <img src="../imagen/devolucion.png" alt="Imagen 4">
                    <img src="../imagen/codigoBarra.png" alt="Imagen 7">
                </div>
            </div>
        </div>
      </section>
      
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
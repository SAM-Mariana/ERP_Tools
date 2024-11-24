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
    <title>p</title>
    <!-- Para poder poner los estilos -->
    <link rel="stylesheet" href="../css/prestamo.css">
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
            <div>
                <img src="../imagen/foto2.png" alt="Foto Usuario" class="circle center-circle">
                <img src="../imagen/logoMazdaMen.png" alt="Logo" class="circle offset-circle">
                <div class="column">
                      <img src="../imagen/prestamo.png" class="option prestamo" alt="Imagen 1">
                    <div class="search-bar">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <a href="#"> <img src="../imagen/sku.png" class="option" alt="Imagen 2"></a>
                        <a href="#"> <img src="../imagen/inventario.png" class="option" alt="Imagen 3"></a>
            </div>
        </div>
        </div>
        <div class="right-column">
            <div class="container-right">
<!----------------------------- funcion para poder guardar datos en formulario ----------------------->
            <?php
            if(isset($_POST['enviar'])){
                $empleado=$_POST['empleado'];
                $folio=$_POST['folio'];
                $date_prestamo=$_POST['date_prestamo'];
                $date_entrega=$_POST['date_entrega'];
                $entrega=$_POST['entrega'];
                $sku=$_POST['sku'];
                $tool=$_POST['tool'];
                $cantidad=$_POST['cantidad'];
        
                include("conexion.php");
                $sql = "INSERT INTO tools (empleado, folio, date_prestamo, date_entrega, entrega, sku, tool, cantidad) 
            VALUES ('" . $empleado . "', '" . $folio . "', '" . $date_prestamo . "', '" . $date_entrega . "', '" . $entrega . "', '" . $sku . "', '" . $tool . "', '" . $cantidad . "')";
        
                $resultado=mysqli_query($conexion,$sql);
                if ($resultado) {
                    // Redirigir a la página del ticket con los datos necesarios
                    header("Location: ticket.php?empleado=$empleado&folio=$folio&date_prestamo=$date_prestamo&date_entrega=$date_entrega&entrega=$entrega&sku=$sku&tool=$tool&cantidad=$cantidad");
                    exit;
                } else {
                    echo "<script>
                            alert('Error al insertar los datos.');
                            location.assign('ticket.php');
                          </script>";
                }
                mysqli_close($conexion);
            }else{
            ?>
<!------------------------------- formulario para guardar datos------- ---------------------------------->
            <div class="form-container">
                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <div class="form-group">
                        <input type="text" name="empleado" placeholder="Nombre del Empleado">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="folio" placeholder="Número de Folio">
                        </div>
                        <div class="form-group">
                            <input type="date" name="date_prestamo" placeholder="Fecha de Préstamo">
                        </div>
                        <div class="form-group">
                            <input type="date" name="date_entrega" placeholder="Fecha de Entrega">
                        </div>
                        <div class="form-group">
                            <select name="entrega">
                                <option value="">Entregado...</option>
                                <option value="si">Sí</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group">
                        <input type="text" name="sku" placeholder="SKU">
                    </div>
                    <div class="form-group">
                        <input type="text" name="tool" placeholder="Herramienta">
                    </div>
                    <div class="form-group">
                        <input type="text" name="cantidad" placeholder="Cantidad">
                    </div>
                </div>
                <div class="agregarB">
                    <button type="submit" name="enviar" value="Agregar" ><img src="../imagen/agregar.png" class="agregar"></button>
                </div>
                </form>
                <?php
                }
                ?>
            </div>
        </div>
<!----------------------------------------- tabla de datos ------------------------------------------------>
<!-- es para poder llaman los datos que tengas en la tabla tools -->
<?php
    include("conexion.php");
    $sql="select * from tools";
    $resultados=mysqli_query($conexion,$sql);
    ?>
        <div class="table-container">
        <table class="data-table">
            <tr>
                <thead>
                    <th>
                        <span>ID</span>
                    </th>
                    <th>
                        <span>Empleado</span>
                    </th>
                    <th>
                        <span>Folio</span>
                    </th>
                    <th>
                        <span>Fecha Prestamo</span>
                    </th>
                    <th>
                        <span>Fecha Entrega</span>
                    </th>
                    <th>
                        <span>Entregado</span>
                    </th>
                    <th>
                      SKU
                    </th>
                    <th>
                       Herramienta
                    </th>
                    <th>
                       Cantidad
                    </th>
                    <th>
                       
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <!------------ funcion donde imprime los datos en la tabla por medio de un while  ---------------------------->                    
                    <?php
                    while($filas=mysqli_fetch_assoc($resultados)){
                    ?>
                    <tr>
                    <!-- en cada uno es una fila la cual debes de llamar el nombre como esta en la base datos-->
                        <td><?php echo $filas['id'] ?></td>
                        <td><?php echo $filas['empleado'] ?></td>
                        <td><?php echo $filas['folio'] ?></td>
                        <td><?php echo $filas['date_prestamo'] ?></td>
                        <td><?php echo $filas['date_entrega'] ?></td>
                        <td><?php echo $filas['entrega'] ?></td>
                        <td><?php echo $filas['sku'] ?></td>
                        <td><?php echo $filas['tool'] ?></td>
                        <td><?php echo $filas['cantidad'] ?></td>
                        <td><?php echo " <a href='editar.php?id=".$filas['id']."'>EDITAR</a>"; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
        </table>
        
    </div>
</div><!--ring-->
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
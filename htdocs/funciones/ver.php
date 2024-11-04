<?php
include '../bdd2.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Consulta para obtener los datos del objeto
$query_objeto = "SELECT * FROM objeto WHERE id = '$id'";
$resultado_objeto = mysqli_query($conexion, $query_objeto);


// Consulta para obtener los registros de actualizaciones relacionados con el objeto
$query_actualizaciones = "SELECT ubicacion_anterior, date1_anterior, date2_nuevo FROM registro_actualizaciones WHERE objeto_id = '$id' ";
$resultado_actualizaciones = mysqli_query($conexion, $query_actualizaciones);

if (isset($resultado_objeto) && $resultado_objeto !== NULL && mysqli_num_rows($resultado_objeto) > 0) {
    $rowSql = mysqli_fetch_assoc($resultado_objeto);
    $date1 = $rowSql["date1"];
    $date2 = $rowSql["date2"];
    
    if (strtotime($date1) > strtotime($date2)) {
        $resultado1 = "En alta"; // date1 es más reciente que date2
    } else {
        $resultado1 = "Dado de baja"; // date2 es igual o más reciente que date1
    }
}

?>

<?php
include '../bdd2.php';

if (isset($_REQUEST["dato"]) && $_REQUEST["dato"] == 'borrar') {
    // Actualizamos los datos para establecer date1 en la marca de tiempo actual
    $id = $_REQUEST["id"];
    mysqli_query($conexion, "UPDATE objeto SET date2 = CURRENT_TIMESTAMP() WHERE id = '" . $id . "'");
    
    $query_objetos = "SELECT * FROM objeto WHERE id = '$id'";
    $resultado_objetos = mysqli_query($conexion, $query_objetos);

    $objeto= mysqli_fetch_assoc($resultado_objetos); // Obtenemos los datos del objeto
    //agrego los datos de objeto en registro actualizaciones
    $query_agregar = "INSERT INTO registro_actualizaciones (objeto_id, ubicacion_anterior, date1_anterior, date2_nuevo)
                VALUES (?, ?, ?, ?)";
    $stmt_insert = $conexion->prepare($query_agregar);
    $stmt_insert->bind_param("isss", $objeto['id'], $objeto['ubicacion'], $objeto['date1'], $objeto['date2']);
    $stmt_insert->execute();

    // Redirigir a la página anterior (página de búsqueda) con la misma consulta
    $previousPage = $_SERVER['HTTP_REFERER'];

    // Verifica si el ID del objeto se pasó como parámetro
    if (strpos($previousPage, 'id=') !== false) {
        // Extraer el ID del objeto de la URL anterior
        $urlParts = parse_url($previousPage);
        parse_str($urlParts['query'], $query);
        $id = isset($query['id']) ? $query['id'] : '';
        
        // Eliminar cualquier parámetro 'id' de la URL anterior
        $previousPage = preg_replace('/[?&]id=[^&]+/', '', $previousPage);
        
        // Agregar el ID del objeto a la URL de redirección si es necesario
        if (!empty($id)) {
            $previousPage .= (strpos($previousPage, '?') === false ? '?' : '&') . 'id=' . $id;
        }
    }
    
    header("Location: $previousPage");
}

mysqli_close($conexion);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museo - ver</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="elementos3.css">

</head>
<body>

<nav class="nav">
			<div class="logo"><a href="../admin.php"><img src="../fotos/logot.png" alt="#"></a></div>
			<a href="../index.php" class="loguear">Cerrar Sesión</a>
		</nav>
</header><br><br>



<div class="contenedor__todo" >

<div class="caja__trasera">
    <div class="caja__trasera-login">

        
                <div class="imag">
                    <?php                      
                    if (isset($rowSql) && !empty($rowSql)) {                    
                    ?>
                    <img src="../<?php echo $rowSql['fotoObj'] ?>" alt="Foto de Objeto" >
                    <img src="../<?php echo $rowSql['fotoUbi'] ?>" alt="Foto de Ubicacion" >
                    <?php 
                    }
                    ?>    
                </div><br><br>
        <table class="table" border="1" style=" background-color: white;">
            <tr style="background-color: #333333; color: #FFFFFF;">
                <th> id </th>
                <th> Nombre </th>
                <th>Ubicación</th>
                <th>Descripción</th>
                <th>Historia</th>
                <th>Estado</th>
                <?php
                    if (isset($rowSql) && !empty($rowSql)) {
                        if (strtotime($rowSql["date2"]) > strtotime($rowSql["date1"])) {
                            echo '<th>Fecha de Baja</th>';
                        }else{
                            echo '<th>Fecha de alta</th>';
                        }
                    }
                ?>
                <th>Modificar</th>
                <?php
                    if (isset($rowSql) && !empty($rowSql)) {
                        if (strtotime($rowSql["date2"]) > strtotime($rowSql["date1"])) {
                            echo '<th>Dar de Alta</th>';
                        }else{
                            echo '<th>Dar de Baja</th>';
                        }
                    }
                ?>
            </tr>
            <?php 
            if (isset($rowSql) && !empty($rowSql)) {
            ?>
            <tr>
                <td><?php echo $rowSql["id"]; ?></td>
                <td><?php echo $rowSql["nombreO"]; ?></td>
                <td><?php echo $rowSql["ubicacion"]; ?></td>
                <td><?php echo $rowSql["descripcion"]; ?></td>
                <td><?php echo $rowSql["historia"]; ?></td>
                <td><?php echo $resultado1; ?></td>
                <?php
                if (strtotime($rowSql["date2"]) > strtotime($rowSql["date1"])) {
                    echo '<td>' . $rowSql["date2"] . '</td>';
                }else{
                    echo '<td>' . $rowSql["date1"] . '</td>';
                }
                ?>
                <td>
                    <a href="modificar.php?dato=modificar&id=<?php echo $rowSql['id']; ?>">
                        <img src="../fotos/modificar.png" alt="Modificar" width="55" height="55">
                    </a>
                </td>
                <?php
                    if (strtotime($rowSql["date2"]) > strtotime($rowSql["date1"])) {
                        echo '<td>
                        <a href="#" onclick="mostrarDialogoDarAlta(' . $rowSql['id'] . ')"><img src="../fotos/alta.png" alt="Modificar" width="55" height="55" ></a>
                        </td>';
                    }else{
                        echo '<td>
                        <a href="ver.php?dato=borrar&id=' . $rowSql['id'] . '"><img src="../fotos/baja.png" alt="Modificar" width="55" height="55" ></a></td>';


                    }
                    ?>
            </tr>
            <?php 
            }
            ?>
        </table><br><br>


            <table class="table" border="1" style="margin: 0 auto; background-color: white;">
            <tr style="background-color: #333333; color: #FFFFFF;">
                <?php
                // Comprueba si date2 es diferente de '0000-00-00 00:00:00'
                if (isset($rowSql) && !empty($rowSql) && $rowSql["date2"] != '0000-00-00 00:00:00') {
                    echo '<th>Ubicacion</th>';
                    echo '<th>Fecha de Alta</th>';
                    echo '<th>Fecha de Baja</th>';
                }
                ?>
              
            </tr>
            <?php 
            if (isset($resultado_actualizaciones) && mysqli_num_rows($resultado_actualizaciones) > 0) {
                while ($rowActualizaciones = mysqli_fetch_assoc($resultado_actualizaciones)) {
                    echo '<tr>';
                    echo '<td>' . $rowActualizaciones["ubicacion_anterior"] . '</td>';
                    echo '<td>' . $rowActualizaciones["date1_anterior"] . '</td>';
                    echo '<td>' . $rowActualizaciones["date2_nuevo"] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>

    </div>
</div>


</div>
</body>
</html>
<script>
function mostrarDialogoDarAlta(id) {
    var ubicacion = prompt("Nueva Ubicación: ", "");
    if (ubicacion !== null) {
        location.href = "alta.php?dato=borrar&id=" + id + "&ubicacion=" + ubicacion;
    }
}
</script>
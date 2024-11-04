<?php
include("bdd2.php");

// Verificar si se ha enviado un archivo
if (!empty($_FILES['dataCliente']['name'])) {
    $archivotmp = $_FILES['dataCliente']['tmp_name'];
    $lineas = file($archivotmp);

    $cantidad_regist_agregados = count($lineas) - 1; // Restamos 1 para excluir la fila de encabezado

    foreach ($lineas as $i => $linea) {
        if ($i != 0) { // Excluir la fila de encabezado
            $datos = explode(";", $linea);
           
            $id = !empty($datos[0]) ? $datos[0] : '';
            $nombreO = !empty($datos[1]) ? $datos[1] : '';
            $ubicacion = !empty($datos[2]) ? $datos[2] : '';
            $descripcion = !empty($datos[3]) ? $datos[3] : '';
            $historia = !empty($datos[4]) ? $datos[4] : '';

            // Verificar si el registro ya existe en la base de datos por su id
            $check_query = "SELECT * FROM objeto WHERE id = '$id'";
            $result = mysqli_query($conexion, $check_query);
            
            if (mysqli_num_rows($result) > 0) {
                // Actualizar el registro existente
                $update_query = "UPDATE objeto 
                                 SET nombreO = '$nombreO', ubicacion = '$ubicacion', descripcion = '$descripcion', historia = '$historia' 
                                 WHERE id = '$id'";
                mysqli_query($conexion, $update_query);
            } else {
                // Insertar el nuevo registro si no existe
                $insert_query = "INSERT INTO objeto (id, nombreO, ubicacion, descripcion, historia)
                                 VALUES ('$id', '$nombreO', '$ubicacion', '$descripcion', '$historia')";
                mysqli_query($conexion, $insert_query);
            }
        }

    }

    // Mostrar el total de registros agregados
    echo '<p style="text-align:center; color:#333;">Total de Registros: ' . $cantidad_regist_agregados . '</p>';
} else {
    echo '<p style="text-align:center; color:#333;">No se ha enviado ningún archivo.</p>';
}
?>
<a href="admin.php">Atrás</a>

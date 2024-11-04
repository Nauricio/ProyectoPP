<?php
include '../bdd2.php';

if (isset($_REQUEST["dato"]) && $_REQUEST["dato"] == 'borrar'){
    // Actualizamos los datos para establecer date1 en la marca de tiempo actual
     $id = $_GET["id"];
     $ubicacion = $_GET["ubicacion"];
     
     mysqli_query($conexion, "UPDATE objeto SET ubicacion = '$ubicacion', date1 = CURRENT_TIMESTAMP() WHERE id = '".$id."'");
     
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

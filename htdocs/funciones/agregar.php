<?php
include '../bdd2.php';

$nombreO = $_POST['nombreO'];
$ubicacion = $_POST['ubicacion'];
$descripcion = $_POST['descripcion'];
$historia = $_POST['historia'];

// Procesa la imagen del objeto
if (isset($_FILES["foto"])) {
    $file = $_FILES["foto"]["name"];
    $url_temp = $_FILES["foto"]["tmp_name"];
    $url_insert = dirname(__FILE__) . "/Descargas"; // Carpeta donde subiremos nuestros archivos
    $url_target = str_replace('\\', '/', $url_insert) . '/' . $file;

    // Si la carpeta no existe, la creamos
    if (!file_exists($url_insert)) {
        mkdir($url_insert, 0777, true);
    }

    // Movemos el archivo de la carpeta temporal a la carpeta objetivo
    if (move_uploaded_file($url_temp, $url_target)) {
        echo "El archivo " . htmlspecialchars(basename($file)) . " ha sido cargado con éxito.";
        $url_target = "funciones/Descargas/" . $file;
    } else {
        echo "Ha habido un error al cargar tu archivo.";
    }
} else {
    $url_target = ''; // Si no se sube una imagen, asigna una cadena vacía
}

if (isset($_FILES["foto1"])) {
    $file = $_FILES["foto1"]["name"];
    $url_temp2 = $_FILES["foto1"]["tmp_name"];
    $url_insert2 = dirname(__FILE__) . "/Descargas"; // Carpeta donde subiremos nuestros archivos
    $url_target2 = str_replace('\\', '/', $url_insert2) . '/' . $file;

    // Si la carpeta no existe, la creamos
    if (!file_exists($url_insert2)) {
        mkdir($url_insert2, 0777, true);
    }

    // Movemos el archivo de la carpeta temporal a la carpeta objetivo
    if (move_uploaded_file($url_temp2, $url_target2)) {
        echo "El archivo " . htmlspecialchars(basename($file)) . " ha sido cargado con éxito.";
        $url_target2 = "funciones/Descargas/" . $file;
    } else {
        echo "Ha habido un error al cargar tu archivo.";
    }
} else {
    $url_target2 = ''; // Si no se sube una imagen, asigna una cadena vacía
}

// Verificar si el nombre del objeto ya existe
$verificar_nombreO = mysqli_query($conexion, "SELECT * FROM objeto WHERE nombreO ='$nombreO'");
if (mysqli_num_rows($verificar_nombreO) > 0) {
    echo '
        <script>
            alert("El nombre del objeto ya está registrado, intenta con otro diferente");
            window.location = "añadir.php";
        </script>
    ';
    exit();
}

// Inserta el nuevo objeto
$query = "INSERT INTO objeto(nombreO, ubicacion, descripcion, historia, fotoUbi, fotoObj, date1, date2) 
          VALUES ('$nombreO', '$ubicacion', '$descripcion', '$historia', '$url_target2', '$url_target', 
          DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 4 HOUR), '0000-00-00 00:00:00')";
$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    

    echo '
        <script>
            alert("Objeto almacenado exitosamente");
            window.location = "../admin.php";
        </script>
    ';
} else {
    echo '
        <script>
            alert("Inténtalo de nuevo, Objeto no almacenado");
            window.location = "añadir.php";
        </script>
    ';
}

mysqli_close($conexion);
?>
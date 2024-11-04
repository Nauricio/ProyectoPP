<?php
    include '../bdd2.php';

    // Recupera el ID de la URL
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    
    // Consulta la base de datos para obtener los datos del objeto
    $query = "SELECT * FROM objeto WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    // Verifica si se obtuvo un resultado antes de intentar acceder a $row
    if (mysqli_num_rows($resultado) == 0) {
        
        echo "Objeto no encontrado.".$id;
        
       
    }
    else
    {
       $row = mysqli_fetch_assoc($resultado); 
    }

    mysqli_close($conexion);
    ?>

    <?php
    include '../bdd2.php';

    if (isset($_POST['edit'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $nuevoNombreO = $_POST['nombreO'];
        $nuevoUbicacion = $_POST['ubicacion'];
        $nuevoDescripcion = $_POST['descripcion'];
        $nuevoHistoria = $_POST['historia'];
        $foto_viejaO = $_POST['fotoObj'];
        $foto_viejaU = $_POST['fotoUbi'];

    // Procesa la imagen del objeto
    if(isset($_FILES["foto"])) {
        $file = $_FILES["foto"]["name"];
        $url_temp = $_FILES["foto"]["tmp_name"];
        //dirname(__FILE__) nos otorga la ruta absoluta hasta el archivo en ejecución
        $url_insert = dirname(__FILE__) . "/Descargas"; //Carpeta donde subiremos nuestros archivos
        $url_target = str_replace('\\', '/', $url_insert) . '/' . $file;

        //Si la carpeta no existe, la creamos
        if (!file_exists($url_insert)) {
            mkdir($url_insert, 0777, true);
        };

        //movemos el archivo de la carpeta temporal a la carpeta objetivo y verificamos si fue exitoso
        if (move_uploaded_file($url_temp, $url_target)) {
            echo "El archivo " . htmlspecialchars(basename($file)) . " ha sido cargado con éxito.";
            $url_target ="funciones/Descargas/" . $file;
            } 
            else {
            echo "Ha habido un error al cargar tu archivo.";
            }


    }
    else {
        $url_target = "$foto_viejaO"; // Si no se sube una imagen, asigna una cadena vacía
    }


       if(isset($_FILES["foto1"])) {
    $file2 = $_FILES["foto1"]["name"];
    $url_temp2 = $_FILES["foto1"]["tmp_name"];
    //dirname(__FILE__) nos otorga la ruta absoluta hasta el archivo en ejecución
    $url_insert2 = dirname(__FILE__) . "/Descargas"; //Carpeta donde subiremos nuestros archivos
    $url_target2 = str_replace('\\', '/', $url_insert2) . '/' . $file2;

    //Si la carpeta no existe, la creamos
    if (!file_exists($url_insert2)) {
        mkdir($url_insert2, 0777, true);
    };

    //movemos el archivo de la carpeta temporal a la carpeta objetivo y verificamos si fue exitoso
    if (move_uploaded_file($url_temp2, $url_target2)) {
        echo "El archivo " . htmlspecialchars(basename($file2)) . " ha sido cargado con éxito.";
        $url_target2 ="funciones/Descargas/" . $file2;
        } 
        else {
           echo "Ha habido un error al cargar tu archivo.";
        }


}
else {
    $url_target2 = "$foto_viejaU"; // Si no se sube una imagen, asigna una cadena vacía
}

        $query = "UPDATE objeto SET nombreO = '$nuevoNombreO', ubicacion = '$nuevoUbicacion', descripcion = '$nuevoDescripcion', historia = '$nuevoHistoria', fotoObj = '$url_target', fotoUbi = '$url_target2' WHERE id = $id";

        $ejecutar = mysqli_query($conexion, $query);

        if ($ejecutar) {
            echo '
                <script>
                    alert("Objeto modificado exitosamente");
                    window.location = "../admin.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Inténtalo de nuevo, Objeto no modificado");
                    window.location = "../admin.php";
                </script>
            ';
        }
    }

    mysqli_close($conexion);
    ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../estilomuseo1.css">
    <title>Museo - Modificar Objeto</title>
</head>
<body>

<nav class="nav">
			<div class="logo"><img src="../fotos/logot.png" alt="#"></div>
			<a href="../index.php" class="loguear">Cerrar Sesión</a>
		</nav>
        <div class="derecha">
<div class="contenido">
				<h1>AGREGAR ELEMENTO +</h1>
				<table>
					<tr>
						<th>NOMBRE</th>
						<th>UBICACIÓN</th>
						<th>DESCRIPCION</th>
						<th>HISTORIA</th>
						<th>IMAGEN ELEMENTO</th>
						<th>IMAGEN UBICACIÓN</th>
					</tr>
					<tr class="segundo">
                        <form action="modificar.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
							<th><input type="text" name="nombreO" value="<?php echo $row['nombreO']; ?>"></th>
							<th><input type="text" name="ubicacion" value="<?php echo $row['ubicacion']; ?>"></th>
							<th><input type="text" name="descripcion" value="<?php echo $row['descripcion']; ?>"></th>
							<th><input type="text" name="historia" value="<?php echo $row['historia']; ?>"></th>
                            
                            <th><div id="previewContainer" >
                                <img id="imagenPreview" src="../<?php echo $row['fotoObj']; ?>" style="width: 100%; height: 100%;" alt="Imagen Preview">
                            </div>
                            <!-- Imagen del Objeto -->
                            <input type="file" name="foto" onchange="previewImage('imagenPreview', this)" ></th>
							<th><!-- Otros campos del formulario... -->
                           
                            <div id="previewContainer2" >
                                <img id="imagenPreview2" src="../<?php echo $row['fotoUbi']; ?>" style="width: 100%; height: 100%;" alt="Imagen Preview">
                            </div>
                            <input type="file" name="foto1" onchange="previewImage2('imagenPreview2', this)"></th> 
							<th><input type="submit" name="edit" value="Modificar"></th>
						</form>
					</tr>
				</table>
			</div>
</div>


<script>
    function previewImage(imageId, input) {
    const image = document.getElementById(imageId);
    const imageContainer = document.getElementById('imageContainer');
    const imageUpload = document.getElementById('imageUpload');

    if (input.files.length > 0) {
        const reader = new FileReader();

        reader.onload = function (e) {
            image.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);

        // Mostrar la imagen y ocultar la opción de carga
        imageContainer.style.display = 'flex';
        imageUpload.style.display = 'none';
    } else {
        // Ocultar el contenedor completo si no hay imagen
        imageContainer.style.display = 'none';
        imageUpload.style.display = 'flex';
    }
}

</script>

</body>
</html>


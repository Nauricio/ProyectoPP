<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../estilomuseo1.css">
    <title>Museo - Añadir Objeto</title>
</head>
<body>

<style>
 #previewContainer{
    float: left; width: 100px; height: 100px; margin-left: 30px; margin-right: 15px;
     overflow: hidden; border: 2px solid #000; display: none; 
 }
 #previewContainer2{
    float: left; width: 100px; height: 100px; margin-left: 30px; margin-right: 15px;
     overflow: hidden; border: 2px solid #000; display: none; margin-top: 15px;
 }
 </style>


<nav class="nav">
			<div class="logo"><img src="../fotos/logot.png" alt="#"></div>
			<a href="../inicio.php" class="loguear">Cerrar Sesión</a>
		</nav>
		
<div class="derecha">
<ul>
				<a href="../admin.php" class="op">ELEMENTOS</a>
			</ul> 
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
						<form action="agregar.php" method="post" enctype="multipart/form-data">
							<th><input type="text" name="nombreO" ></th>
							<th><input type="text" name="ubicacion" ></th>
							<th><input type="text" name="descripcion" ></th>
							<th><input type="text" name="historia" ></th>
							<th><div id="previewContainer" >
                                <img id="imagenPreview" style="width: 100%; height: 100%;" alt="Imagen Preview">
                            </div>
                            <!-- Imagen del Objeto -->
                            <input type="file" name="foto" onchange="previewImage('imagenPreview', this)" ></th>
							<th><!-- Otros campos del formulario... -->
                            <div id="previewContainer2" >
                                <img id="imagenPreview2" style="width: 100%; height: 100%;" alt="Imagen Preview">
                            </div>

                            <input type="file" name="foto1" onchange="previewImage2('imagenPreview2', this)"></th>
							<th><input type="submit" value="Guardar"></th>
						</form>
					</tr>
				</table>
			</div>
</div>
<script>
    function previewImage(imageId, input) {
        const image = document.getElementById(imageId);
        const previewContainer = document.getElementById('previewContainer');

        const reader = new FileReader();

        reader.onload = function (e) {
            image.src = e.target.result;
            previewContainer.style.display = 'block'; // Mostrar el contenedor de vista previa
        };

        reader.readAsDataURL(input.files[0]);
    }

    function previewImage2(imageId, input) {
        const image = document.getElementById(imageId);
        const previewContainer2 = document.getElementById('previewContainer2');

        const reader = new FileReader();

        reader.onload = function (e) {
            image.src = e.target.result;
            previewContainer2.style.display = 'block'; // Mostrar el contenedor de vista previa
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>

</body>
</html>

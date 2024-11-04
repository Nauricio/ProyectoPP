<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="estilomuseo1.css"/>
        <title>MUSEO</title>
    </head>
    <body>
    <style>

    /* Estilos para el contenedor */
    .contenedor__todo {
        display: flex;
        justify-content: center;
        align-items: center;    
        flex-wrap: wrap; /* Permite que los objetos se envuelvan a la siguiente fila */
        height: auto;
    }

    /* Estilos para la caja trasera */
    .caja__trasera {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    height: 350px; /* Ajusta la altura total de la caja trasera */
    width: 250px;
    margin: 10px; /* Agregar margen para separar las cajas */
    }

    /* Estilos para las imágenes */
    .imag img {
        width: 100%;
        max-height: 250px; /* Ajusta la altura máxima de la imagen */
    }

    /* Estilos para el nombreO */
    .nombreO {
    flex-grow: 1; /* Hace que el nombreO ocupe el espacio restante dentro de la caja trasera */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    }

    .nombreO h2 {
        font-size: 24px;
        color: black;
    }

    /* Estilo para el formulario de búsqueda */



    /* Estilo para los select de filtrado */
    select {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px;
        margin-left: 15px;
    }

    /* Estilo para el botón de búsqueda */
    #btn-buscar {
        background-color: #dc3545;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        margin-left: 15px;
    }

    #btn-buscar:hover {
        background-color: #b70025;
    }
     /* Estilo para el botón de guia */
    .guia img{
        width:50px;
        height:50px;
    }

</style>
    <nav class="nav">
    <div class="logo"><a href="index.php"><img src="fotos/logot.png" alt="#"></a></div>
    <div class= "signo_pregunta">
        <a class="guia" href="guia.php"> 
            <img src="fotos/signo_pregunta.png" alt="Guía">
        </a>        

    </div>
		<form id="form2" name="form2" method="POST" action="invitado.php">
            <div class="search">
				<input type="search" id="buscar" name="buscar" placeholder="Nombre del Articulo" value="<?php echo isset($_POST["buscar"]) ? $_POST["buscar"] : ''; ?>">
			</div>
        
        <button id="btn-buscar" type="submit">Buscar</button>
            </form>
			<a href="login.php" class="loguear">Abrir Sesión</a>
		</nav>
<?php
include("bdd2.php");

if (isset($_POST["buscar"])) {
    $buscar = $_POST["buscar"];
    $resultado1 = isset($_POST["resultado1"]) ? $_POST["resultado1"] : "si";
    $resultado2 = isset($_POST["resultado2"]) ? $_POST["resultado2"] : "todos";

    if ($resultado1 === "todos") {
        if ($resultado2 === "todos") {
            $query = "SELECT * FROM objeto WHERE (nombreO LIKE '%$buscar%'  OR id = '$buscar')";
        } else if ($resultado2 === "v") {
            $query = "SELECT * FROM objeto WHERE LEFT(ubicacion, 2) = '$buscar'";
        } else {
            $query = "SELECT * FROM objeto WHERE ubicacion = '$buscar'";
        }
    } else {
        if ($resultado2 === "todos") {
            $query = "SELECT * FROM objeto WHERE (nombreO LIKE '%$buscar%'  OR id = '$buscar') AND (
                (date1 > date2 AND '$resultado1' = 'si') 
            )";
        } else if ($resultado2 === "v") {
            $query = "SELECT * FROM objeto WHERE LEFT(ubicacion, 2) = '$buscar' AND ((date1 > date2 AND '$resultado1' = 'si') )";
        } else {
            $query = "SELECT * FROM objeto WHERE ubicacion = '$buscar' AND ((date1 > date2 AND '$resultado1' = 'si') )";
        }
    }

    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }
}
?>
<br>


    
<div class="contenedor__todo">
    <?php
    // Verificamos si $resultado está definido y no es NULL
    if (isset($resultado) && $resultado !== NULL) {
        while ($rowSql = mysqli_fetch_assoc($resultado)) {
            // Calcular el estado para cada objeto
            $date1 = $rowSql["date1"];
            $date2 = $rowSql["date2"];
            ?>
            <a href="invitado_ver.php?id=<?php echo $rowSql['id']; ?>">
                <div class="caja__trasera">
                    <div class="imag">
                        <img src="<?php echo $rowSql['fotoObj'] ?>"  alt="Foto de objeto">
                    </div>
                    <div class="nombreO">
                        <h2><?php echo $rowSql["nombreO"]; ?></h2>
                    </div>
                </div>
            </a>
            <?php
        }
    }
    ?>
</div>
        
        <footer style="background: rgb(231,27,27); color: #fff; padding: 20px; text-align: center;">
    <div style="margin-bottom: 10px;">
        <p>&copy; 2024 Museo Otto Krause. Todos los derechos reservados.</p>
    </div>
    <div style="margin-bottom: 10px;">
        <a href="https://www.facebook.com" target="_blank" style="color: #fff; margin: 0 10px;">Facebook</a>
        <a href="https://www.instagram.com" target="_blank" style="color: #fff; margin: 0 10px;">Instagram</a>
    </div>
</footer>

</body>
</html>

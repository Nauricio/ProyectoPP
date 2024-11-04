<?php
include 'bdd2.php';

$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Consulta para obtener los datos del objeto
$query_objeto = "SELECT * FROM objeto WHERE id = '$id'";
$resultado_objeto = mysqli_query($conexion, $query_objeto);

// Consulta para obtener los registros de actualizaciones relacionados con el objeto
$query_actualizaciones = "SELECT ubicacion_anterior, date1_anterior, date2_nuevo FROM registro_actualizaciones WHERE objeto_id = '$id'";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museo - ver</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="funciones/elementos3.css">

</head>
<body>

        <style>
                body{
                    background: #f2f2f3;
                }
                .negro{
                    background: #191616;
                    height: 450px;
                }
                .menu{
                    background: #211D1D;
                }
                .descripcion {
                max-width: 350px; /* Limita el ancho a 300px */               
                }
                .table{
                    width: 50%;
                    
                }
                .historia-container {
                max-width: 800px;
                margin: 0 auto; /* Centra horizontalmente */
                
                }

                .historia-text {
                    font-size: 17px;
                    color: #212529;
                }
                .imag {
                    display: flex; /* Utiliza flexbox para colocar los elementos en fila */
                    justify-content: center; /* Centra horizontalmente los elementos */     
                }

                .hola {
                    margin-left: -50px; /* Espacio entre la imagen y los elementos h2 */
                    text-align: left; /* Alinea el texto a la izquierda */
                }

                .imag img {
                    border: none;
                }

                /* Añade estilos para las h2 dentro del contenedor de la imagen */
                .imag h2 {
                    font-size: 23px;
                    margin: 5px 10px; /* Espacio entre los elementos h2 */
                    color: white;
                }
                                
        </style>

<nav class="nav">
			<div class="logo"><img src="fotos/logot.png" alt="#"></div>
			<a href="login.php" class="loguear">Iniciar Sesión</a>
		</nav>



<div class="contenedor__todo" >

<div class="caja__trasera">
    <div class="caja__trasera-login">

        <div class= "negro">
            <br><br>
                <div class="imag">
                <?php if (isset($rowSql) && !empty($rowSql)) {  ?>
                    <img style=" border: none;" src="<?php echo $rowSql['fotoObj'] ?>" alt="Foto de Objeto">
                    <div class="hola">
                    <h1 style="color: white;"><?php echo $rowSql["nombreO"]; ?></h1>
                    <h2 style="font-size: 30px;">Ubicación:</h2>
                    <h2 ><?php echo $rowSql["ubicacion"]; ?></h2><br>
                    <h2 style="font-size: 30px;">Descripción:</h2>
                    <h2 class="descripcion" ><?php echo $rowSql["descripcion"]; ?></h2>
                </div>
                <?php }  ?>    
            </div>           
        </div><br><br>


        <div class="historia-container">
        <h1 style="font-size: 28px; color: #212529;">Historia</h1><br>
        <h1 style="font-size: 23px; color: #212529;"><?php echo $rowSql["historia"]; ?></h1>
        </div>   


            

    </div>
</div>


</div>
</body>
</html>

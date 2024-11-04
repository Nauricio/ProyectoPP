 <!--Creado por:
Ceballos Leandro - Pinto Herver - Ajhuacho Axel (2023)
Castromonte Facundo - Cardozo Lautaro - Quiroga Agustin (2024)-->
    

</footer>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilomuseo1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MUSEO</title>
</head>
<body>
    <style>
        select {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 5px;
            margin-left: 15px;
        }
        #btn-buscar, .exportar {
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
        .table {
            width: 100%;
            table-layout: auto;
        }
        .table td:nth-child(3) {
            min-width: 150px;
            white-space: normal;
            word-wrap: break-word;
        }
        .guia {
            display : inline-block;
            margin-left:175px;
            margin-bottom:30px;
        }
        .guia img {
            width: 40px;
            height: 40px;
            cursor: pointer;
        }
        

    </style>

    <nav class="nav">
        <div class="logo">
            <img src="fotos/logot.png" alt="#">
        

        </div>
            <div class= "signo_pregunta">
                <p>Ayuda</p>
                <a class="guia" href="guia.php">
                    <img src="fotos/signo_pregunta.png" alt="Guía">
                </a>        

            </div>    

        <form id="form2" name="form2" method="POST" action="admin.php">
            <div class="search">
                <input type="search" id="buscar" name="buscar" placeholder="Nombre del Artículo" value="<?php echo isset($_POST["buscar"]) ? $_POST["buscar"] : ''; ?>">
            </div>
            <select id="resultado1" name="resultado1">
                <option value="todos">Todos los Estados</option>
                <option value="si">En Alta</option>
                <option value="no">Dado de Baja</option>
            </select>
            <br><br>
            <button id="btn-buscar" type="submit">Buscar</button>
        </form>
        <a href="index.php" class="loguear">Cerrar Sesión</a>
    </nav>

    <div class="derecha">
        <br>
        <ul>
            <a href="funciones/añadir.php" class="op">AGREGAR ELEM.+</a>
            <a href="funciones/dato_usuario.php" class="op">USUARIO</a>
        </ul>    
        <h1>Elementos Del Museo</h1>

<?php
    include("bdd2.php");

    if (isset($_POST["buscar"])) {
        $buscar = $_POST["buscar"];
        $resultado1 = isset($_POST["resultado1"]) ? $_POST["resultado1"] : "todos";
        $resultado2 = isset($_POST["resultado2"]) ? $_POST["resultado2"] : "todos";

        if ($resultado1 === "todos") {
            if ($resultado2 === "todos") {
                $query = "SELECT * FROM objeto WHERE (nombreO LIKE '%$buscar%' OR descripcion LIKE '%$buscar%' OR id = '$buscar')";
            } else if ($resultado2 === "v") {
                $query = "SELECT * FROM objeto WHERE LEFT(ubicacion, 2) = '$buscar'";
            } else {
                $query = "SELECT * FROM objeto WHERE ubicacion = '$buscar'";
            }
        } else {
            if ($resultado2 === "todos") {
                $query = "SELECT * FROM objeto WHERE (nombreO LIKE '%$buscar%' OR descripcion LIKE '%$buscar' OR id = '$buscar') AND (
                    (date1 > date2 AND '$resultado1' = 'si') OR (date1 <= date2 AND '$resultado1' = 'no')
                )";
            } else if ($resultado2 === "v") {
                $query = "SELECT * FROM objeto WHERE LEFT(ubicacion, 2) = '$buscar' AND ((date1 > date2 AND '$resultado1' = 'si') OR (date1 <= date2 AND '$resultado1' = 'no'))";
            } else {
                $query = "SELECT * FROM objeto WHERE ubicacion = '$buscar' AND ((date1 > date2 AND '$resultado1' = 'si') OR (date1 <= date2 AND '$resultado1' = 'no'))";
            }
        }

        $resultado = mysqli_query($conexion, $query);

        if (!$resultado) {
            die("Error en la consulta: " . mysqli_error($conexion));
        }
    }
?>

        <br>
        <form method="POST" action="exportar_excel.php">
            <button class="exportar" name="export"><span class="glyphicon glyphicon-print"></span> Exportar</button>
        </form>
        <form action="recibe_excel_validando.php" method="POST" enctype="multipart/form-data">
            <div class="text-center mt-5"></div>
        </form>
        <input type="hidden" name="dato" value="modificar">
        <div class="table-responsive">
            <table class="table" border="1">
                <?php if (isset($resultado) && $resultado !== NULL) : ?>
                    <thead>
                        <tr style="background-color: #333333; color:#FFFFFF;">
                            <th>id</th>
                            <th>Nombre</th>
                            <th>Ubicación</th>
                            <th>Descripción</th>
                            <th>Historia</th>
                            <th>Foto de objeto</th>
                            <th>Fecha de ingreso</th> 
                            <th>Ver</th>                      
                        </tr>
                    </thead>
                <?php endif; ?>    
                <tbody>
                    <?php 
                    if (isset($resultado) && $resultado !== NULL) {
                        while ($rowSql = mysqli_fetch_assoc($resultado)) {
                            $date1 = $rowSql["date1"];
                            $date2 = $rowSql["date2"];
                            $resultado1 = strtotime($date1) > strtotime($date2) ? "si" : "no";
                            ?>
                            <tr <?php if ($resultado1 === 'no') echo 'style="background-color: #f5f6ab;"'; ?>>
                                <td><?php echo $rowSql["id"]; ?></td>
                                <td><?php echo $rowSql["nombreO"]; ?></td>
                                <td><?php echo $rowSql["ubicacion"]; ?></td>
                                <td><?php echo $rowSql["descripcion"]; ?></td>
                                <td><?php echo $rowSql["historia"]; ?></td>
                                <td><img src="<?php echo $rowSql['fotoObj']; ?>" width="100" height="100"></td>                                        
                                <td><?php echo $rowSql["date1"]; ?></td>                                                               
                                <td>
                                    <a href="funciones/ver.php?id=<?php echo $rowSql['id']; ?>">
                                        <img src="fotos/ver.png" alt="Ver" width="55" height="55">
                                    </a>
                                </td>
                            </tr>
                            <?php 
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
        <footer style="background: rgb(231,27,27); color: #fff; padding: 10px; text-align: center; margin-top:50px;">
    <div style="margin-bottom: 10px;">
        <p>&copy; 2024 Museo Otto Krause. Todos los derechos reservados.</p>
    </div>
    <div style="margin-bottom: 10px;">
        <a href="https://www.facebook.com/ETOTTOKRAUSE" target="_blank" style="color: #fff; margin: 0 10px;">Facebook</a>
        <a href="https://www.instagram.com/et_otto_krause" target="_blank" style="color: #fff; margin: 0 10px;">Instagram</a>
    </div>
</footer>

</body>
</html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../estilomuseo1.css">
        <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>MUSEO</title>
    </head>
    <body>
        <style>
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
        </style>
        <nav class="nav">
			<div class="logo"><a href="../admin.php"><img src="../fotos/logot.png" alt="#"></a></div>
		<form ID="form2" name="form2" method="POST" action="dato_usuario.php">
            <div class="search">
				<input type="search" ID="buscar" name="buscar" placeholder="Nombre del Articulo" value="<?php echo isset($_POST["buscar"]) ? $_POST["buscar"] : ''; ?>">
			</div>
        <button ID="btn-buscar" type="submit">Buscar</button>
            </form>
			<a href="../index.php" class="loguear">Cerrar Sesión</a>
		</nav>
		
        <div class="derecha">
            <br> 
        <h1>Información del Usuario</h1>
            
<?php
        include("../bdd.php");

if (isset($_POST["buscar"])) {
    $buscar = $_POST["buscar"];
    $resultado1 = isset($_POST["resultado1"]) ? $_POST["resultado1"] : "todos";
    $resultado2 = isset($_POST["resultado2"]) ? $_POST["resultado2"] : "todos";

    if ($resultado1 === "todos") {
        if ($resultado2 === "todos") {
        $query = "SELECT * FROM personal WHERE (nombre_completo LIKE '%$buscar%' OR usuario LIKE '%$buscar%' OR ID = '$buscar')";
        }
}
    
    $resultado = mysqli_query($conexion, $query);
    
    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }
}
    ?>
                        <br>
                        <input type="hidden" name="dato" value="modificar">
                        <div class="table-responsive">
                            <table class="table" border="1" style="width: 80%;">
                                <?php if (isset($resultado) && $resultado !== NULL) : ?>
                                    <thead>
                                        <tr style="background-color: #333333; color:#FFFFFF;">
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Usuario</th> 
                                            <th>Editar</th>                     
                                        </tr>
                                    </thead>
                                <?php endif; ?>    
                                <tbody>
                                    <?php 
                                    // Verificamos si $resultado está definIDo y no es NULL
                                    if (isset($resultado) && $resultado !== NULL) {
                                        while ($rowSql = mysqli_fetch_assoc($resultado)) {
                                           
                                            ?>
                                            <tr <?php if ($resultado1 === 'no') echo 'style="background-color: #f5f6ab;"'; ?>>
                                                <td><?php echo $rowSql["ID"]; ?></td>
                                                <td><?php echo $rowSql["nombre_completo"]; ?></td>
                                                <td><?php echo $rowSql["correo"]; ?></td>
                                                <td><?php echo $rowSql["usuario"]; ?></td>
                                                <td>
                                                   <a href="modificar_usuario.php?dato=modificar_usuario&ID=<?php echo $rowSql['ID']; ?>">
                                                    <img src="../fotos/modificar.png" alt="Modificar" width="55" height="55">
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

</body>
</html>

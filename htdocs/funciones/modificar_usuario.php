<?php
    include '../bdd.php';

    // Recupera el ID de la URL
    $id = isset($_GET['ID']) ? $_GET['ID'] : 0;

    // Consulta la base de datos para obtener los datos del objeto
    $query = "SELECT * FROM personal WHERE ID = $id";
    $resultado = mysqli_query($conexion, $query);

    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conexion));
    }

    // Verifica si se obtuvo un resultado antes de intentar acceder a $row
    if (mysqli_num_rows($resultado) > 0) {
        $row = mysqli_fetch_assoc($resultado);
    } else {
        echo "Objeto no encontrado.";
    }
    $rolUsuario = $row['tipo'];
    mysqli_close($conexion);
?>

<?php
    include '../bdd.php';

    if (isset($_POST['edit'])) {
        $id = isset($_POST['ID']) ? $_POST['ID'] : 0;
        $nuevoNombre = $_POST['nombre_completo'];
        $nuevoCorreo = $_POST['correo'];
        $nuevoUsuario = $_POST['usuario'];
        $nuevoPassword = $_POST['password'];
        $query = "UPDATE personal SET nombre_completo = '$nuevoNombre', correo = '$nuevoCorreo', usuario = '$nuevoUsuario', password = '$nuevoPassword' WHERE ID = $id";

        $ejecutar = mysqli_query($conexion, $query);

        if ($ejecutar) {
            echo '
                <script>
                    alert("Usuario modificado exitosamente");
                    window.location = "dato_usuario.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Inténtalo de nuevo, usuario no modificado");
                    window.location = "dato_usuario.php";
                </script>
            ';
        }
    }

    // Nueva sección para cambiar el rol del usuario
    if (isset($_POST['cambiar_rol'])) {
        $id = isset($_POST['ID']) ? $_POST['ID'] : 0;

        // Consulta el rol actual del usuario
        $query_tipo = "SELECT tipo FROM personal WHERE ID = $id";
        $resultado_tipo = mysqli_query($conexion, $query_tipo);
        $row_tipo = mysqli_fetch_assoc($resultado_tipo);

        // Cambia el rol: si es 'invitado', lo cambia a 'administrador', y viceversa
        $nuevoRol = ($row_tipo['tipo'] == 'invitado') ? 'administrador' : 'invitado';

        $query = "UPDATE personal SET tipo = '$nuevoRol' WHERE ID = $id";
        $ejecutar = mysqli_query($conexion, $query);

        if ($ejecutar) {
            echo '
                <script>
                    alert("Rol del usuario cambiado exitosamente");
                    window.location = "dato_usuario.php";
                </script>
            ';
        } else {
            echo '
                <script>
                    alert("Error al cambiar el rol, inténtalo de nuevo");
                    window.location = "dato_usuario.php";
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
    <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../estilos1.css">
    <title>Museo - Modificar Objeto</title>
</head>
<body>
    <form action="modificar_usuario.php" method="post" enctype="multipart/form-data">
        <h1>Registrarse</h1>    
        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
        <th><input type="text" name="nombre_completo" value="<?php echo $row['nombre_completo']; ?>"></th>
        <th><input type="text" name="correo" value="<?php echo $row['correo']; ?>"></th>
        <th><input type="text" name="usuario" value="<?php echo $row['usuario']; ?>"></th>
        <th><input type="password" name="password" value="<?php echo $row['password']; ?>"></th>
                        <!--muestra que tipo de rol tiene asignado el usuario -->
        <p class="rol-usuario">Rol asignado: <strong><?php echo $rolUsuario; ?></strong></p>
        <th><input type="submit" name="edit" value="Modificar"></th>
        <!-- Botón para cambiar el rol -->
        <th><input type="submit" name="cambiar_rol" value="Cambiar Rol de Usuario"></th>
    </form>
</body>
</html>
<?php
include('bdd.php');

$USUARIO = $_POST['usuario'];
$PASSWORD = trim($_POST['password']); // Asegúrate de eliminar espacios en blanco

// Consulta solo el usuario y la contraseña encriptada
$consulta = "SELECT * FROM personal WHERE usuario = '$USUARIO'";
$resultado = mysqli_query($conexion, $consulta);

if ($resultado) {
    $row = mysqli_fetch_assoc($resultado);

    // Verificamos que exista el usuario
    if ($row) {
        
    
        // Comparamos la contraseña ingresada con la contraseña encriptada
        if (password_verify($PASSWORD, $row['password'])) {
            // Contraseña correcta, redirigimos según el tipo de usuario
            if ($row['tipo'] == 'invitado') {
                header("location:invitado.php");
            } elseif ($row['tipo'] == 'administrador') {
                header("location:admin.php");
            }
        } else {
            // Contraseña incorrecta
            include("login.php");
            echo "<script> alert('ERROR DE CONTRASEÑA'); </script>";
        }
    } else {
        // Usuario no encontrado
        include("login.php");
        echo "<script> alert('ERROR DE USUARIO'); window.location= 'login.php' </script>";
    }

    mysqli_free_result($resultado);
} else {
    // Error en la consulta
    echo "<script> alert('Error en la base de datos'); window.location= 'login.php' </script>";
}

mysqli_close($conexion);
?>

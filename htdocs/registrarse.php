<!DOCTYPE html>
<html>
<head>
	<title>Registrar usuario</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="estilos1.css">
</head>
<body>
    <form action="registro_usuario.php" method="post">
    	<h1>Registrarse</h1>
        <input type="text" placeholder="Nombre Completo" name = "nombre_completo" required>
        <input type="text" placeholder="Correo Electronico" name = "correo" required>
    	<input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
    	<input type="submit" name="register" value="REGISTRAR">
    </form>
</body>
</html>

<?php
$host = 'sql305.infinityfree.com';
$usuario = 'if0_37026885';
$contraseña = 'qvzHJ0M78CMT';
$base_datos = 'if0_37026885_validar';

// Crear una conexión a la base de datos
$conexion = mysqli_connect($host, $usuario, $contraseña, $base_datos);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Opcional: Establecer el conjunto de caracteres
mysqli_set_charset($conexion, 'utf8');

// Código adicional para la aplicación aquí


?>
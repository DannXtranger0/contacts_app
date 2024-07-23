<?php
$dsn = 'mysql:host=localhost;dbname=sistema_contactos';
$usuario = 'root';
$contrasenia = '';

try {
    $conexion = new PDO($dsn, $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    die();
}
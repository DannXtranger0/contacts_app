<?php
session_start();
include_once("conexion.php");

$sql = "UPDATE contactos set nombre_contacto = :nombre_contacto,
 correo = :correo, telefono = :telefono WHERE id_contacto = :id_contacto";

$stmt = $conexion->prepare($sql);
$stmt -> bindParam(":id_contacto", $_SESSION["id_contacto"], PDO::PARAM_INT);
$stmt -> bindParam(":nombre_contacto", $_POST["nombre_contacto"], PDO::PARAM_STR);
$stmt -> bindParam(":telefono", $_POST["telefono"], PDO::PARAM_STR);
$stmt -> bindParam(":correo", $_POST["correo"], PDO::PARAM_STR);


if($stmt -> execute()) {
    header('Location:\sistema_contactos\modificar_contacto_logica.php');
}
?>
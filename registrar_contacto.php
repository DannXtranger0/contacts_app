<?php 
session_start();
$_SESSION["nombre_usuario"] = $_POST["nombre_ingresado"];
$_SESSION["usuario"] = $_POST["usuario_ingresado"];

if(isset($_POST["nombre_ingresado"]) && isset($_POST["usuario_ingresado"]) && isset($_POST["contrasena_ingresada"])){


include_once("conexion.php");


$nombre = $_POST["nombre_ingresado"];
$usuario = $_POST["usuario_ingresado"];
$contrasena = $_POST["contrasena_ingresada"];


$sql = "INSERT INTO usuarios (nombre_usuario,usuario, contrasena) VALUES (:nombre, :usuario, :contrasena)";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
$stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);

if($stmt->execute()){

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario and  contrasena = :contrasena";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':usuario', $_POST["usuario_ingresado"], PDO::PARAM_STR); // Corrección aquí
    $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
    $stmt->execute();

    $usuarioExtraido = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION["id_usuario"] =$usuarioExtraido["id_usuario"] ;

    header('Location: listar_contactos.php');
}else{
    echo "<script>alert ('Nada, mi hermano.')</script>";
}


}
?>
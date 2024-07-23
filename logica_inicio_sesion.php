<?php 
session_start();
$_SESSION["usuario"] = $_POST["usuario_ingresado"];

include_once("conexion.php");
$nombre_usuario_ingresado = $_POST["usuario_ingresado"];
$contrasena_ingresada = $_POST["contrasena_ingresada"];

$sql = "SELECT * FROM usuarios WHERE usuario = :usuario and  contrasena = :contrasena";
$stmt = $conexion->prepare($sql);
$stmt ->bindParam(':usuario',$nombre_usuario_ingresado,PDO::PARAM_STR);
$stmt ->bindParam(':contrasena',$contrasena_ingresada,PDO::PARAM_STR);
$stmt ->execute();

$datosIngresados = $stmt->fetch(PDO::FETCH_ASSOC);

if($nombre_usuario_ingresado == $datosIngresados["usuario"] && $contrasena_ingresada == $datosIngresados["contrasena"]){
    session_start();
    
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario and  contrasena = :contrasena";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':usuario', $nombre_usuario_ingresado, PDO::PARAM_STR); // Corrección aquí
    $stmt->bindParam(':contrasena', $contrasena_ingresada, PDO::PARAM_STR);
    $stmt->execute();

    $usuarioExtraido = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION["id_usuario"] =$usuarioExtraido["id_usuario"] ;
    $_SESSION['usuario'] = $nombre_usuario_ingresado;


    header('Location: listar_contactos.php');
  


}else{
    echo "nostas";
}

?>
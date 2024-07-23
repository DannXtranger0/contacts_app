<?php
# Conexión a la base de datos utilizando PDO
include_once("conexion.php");
session_start();

# Recibir datos del formulario
$nombreIngresado = $_POST['nombre_contacto'];
$telefonoIngresado = $_POST['telefono'];
$correoIngresado = $_POST['correo'];    

# Insertar nuevo contacto en la base de datos
$sql = "INSERT INTO contactos (nombre_contacto,telefono,correo) VALUES (:nombre_contacto,:telefono,:correo)";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':nombre_contacto', $nombreIngresado, PDO::PARAM_STR);
$stmt->bindParam(':telefono',$telefonoIngresado, PDO::PARAM_STR);
$stmt->bindParam(':correo', $correoIngresado, PDO::PARAM_STR);

try {
    if($stmt->execute()){

        $sql = "SELECT * FROM contactos WHERE nombre_contacto = :nombre_contacto and  correo = :correo";
        $stmt = $conexion->prepare($sql);
        $stmt ->bindParam(':nombre_contacto',$nombreIngresado,PDO::PARAM_STR);
        $stmt ->bindParam(':correo',$correoIngresado,PDO::PARAM_STR);
        $stmt ->execute();
        $contactoIngresado = $stmt->fetch(PDO::FETCH_ASSOC);


        $sql = "INSERT INTO contactosXUsuarios (id_usuario,id_contacto) VALUES (:id_usuario, :id_contacto)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id_usuario', $_SESSION["id_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(':id_contacto',$contactoIngresado["id_contacto"], PDO::PARAM_STR);
        $stmt ->execute();
        
    }
    echo "<script>alert ('Contacto agregado exitosamente.')</script>";
    header('Location: listar_contactos.php');
} catch (PDOException $e) {
    echo "Error al agregar contacto: " . $e->getMessage();
}
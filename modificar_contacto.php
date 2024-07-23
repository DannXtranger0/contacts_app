<?php
include_once("conexion.php");
session_start();
$id_contacto = $_GET["id_contacto"];
$_SESSION["id_contacto"] = $id_contacto;

$sql = "SELECT * FROM contactos where id_contacto = :id_contacto";
$stmt = $conexion ->prepare($sql);
$stmt->bindParam(":id_contacto", $id_contacto, PDO::PARAM_INT);
$stmt->execute();
$contactoExtraido = $stmt->fetch(PDO::FETCH_ASSOC);

$conexion = null;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Contacto</title>
</head>
<body>
    <h1>MODIFICACION DE CONTACTO</h1>
    
    <!-- Formulario para agregar un nuevo contacto -->
    <h2>Modificar Contacto</h2>
    <form action="modificar_contacto_logica.php" method="POST">
        <input type="text" name="nombre_contacto" placeholder="Nombre del contacto" value="<?php echo $contactoExtraido["nombre_contacto"]?>">
        <br/>
        <input type="tel" name="telefono" placeholder="Número de celular" value="<?php echo $contactoExtraido["telefono"]?>" required>
        <br/>
        <input type="email" name="correo" placeholder="Correo" value="<?php echo $contactoExtraido["correo"]?>"required>
        <br/>
        <input type="submit" value="Modificar Contacto"></input> <br> <br>

    </form>

  
</body>
</html>

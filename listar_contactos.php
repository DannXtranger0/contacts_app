<?php
# Conexión a la base de datos utilizando PDO
include_once("conexion.php");
session_start();
# Consultar la lista de contactos desde la base de datos
$sql = "SELECT c.id_contacto, c.nombre_contacto, c.correo, c.telefono FROM contactos as c
JOIN contactosXUsuarios as cxu ON c.id_contacto = cxu.id_contacto
JOIN usuarios as  u ON u.id_usuario = cxu.id_usuario 
WHERE u.id_usuario = :id_usuario";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':id_usuario', $_SESSION["id_usuario"], PDO::PARAM_INT); 
$stmt->execute();

$contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);

# Cerrar conexión
$conexion = null;

if($contactos == null){
    echo "No tienes contactos";
   echo "<a href='agregar_contacto.php'>Agregar nuevo contacto</a>"; 
}else{


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA de Contactos</title>
</head>
<body>
    <!-- Lista de contactos -->
    <h1>Contactos Registrados</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>telefono</th>
            <th>Opciones</th>
        </tr>
        <?php foreach ($contactos as $contacto): ?>
        <tr>
            <td><?php echo $contacto['nombre_contacto']; ?></td>
            <td><?php echo $contacto['correo']; ?></td>
            <td><?php echo $contacto['telefono']; ?></td>
            
            <td>
            <a href='modificar_contacto.php?id_contacto=<?= $contacto["id_contacto"];?>'>Modificar</a>
            <a href='eliminar_contacto.php?id_contacto=<?= $contacto["id_contacto"];?>'>Eliminar</a>
            </td>
             <?php endforeach; ?>

    </table>

    <br/>
    <br/>
    <br/>
    <br/>
    <a href="agregar_contacto.php">Agregar nuevo contacto</a>  

<!--
     <form action="agregar_contacto.php" method="POST">
            <input type="submit" value="Agregar Contacto"></input>  <br/>  <br/>  <br/> <br/>
    </form>

    <form action="modificar_contacto.php" method="POST">
            <input type="submit" value="Editar Contacto"></input>
    </form>

    <form action="eliminar_contacto.php" method="POST">
            <input type="submit" value="Eliminar Contacto"></input>
    </form> -->
<form action="cerrar_sesion.php" method="post">
<input type="submit" value="Cerrar Sesión">
</form>

</body>
</html>
<?php
}
?>
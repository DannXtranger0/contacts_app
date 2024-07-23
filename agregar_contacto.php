<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Contacto</title>
</head>
<body>
    <h1>AGREGAR CONTACTO</h1>
    
    <!-- Formulario para agregar un nuevo contacto -->
    <h2>Agregar Contacto</h2>
    <form action="agregar_contacto_logica.php" method="POST">
        <input type="text" name="nombre_contacto" placeholder="Nombre del contacto" required>
        <br/>
        <input type="tel" name="telefono" placeholder="Número de celular" required>
        <br/>
        <input type="email" name="correo" placeholder="Correo" required>
        <br/>
        <input type="submit" value="Agregar Contacto"></input> <br> <br>

    </form>

  
</body>
</html>

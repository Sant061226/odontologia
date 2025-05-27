<!DOCTYPE html>
<html>

<head>
    <title>Sistema de Gestión Odontológica</title>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <link href="Vista/jquery/jquery-ui-1.14.1/jquery-ui.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="Vista/jquery/jquery.js"></script>
    <script src="Vista/jquery/jquery-ui-1.14.1/jquery-ui.js" type="text/javascript"></script>
    <script src="Vista/js/script.js" type="text/javascript"></script>
    <script>
    </script>

<body>
    <div id="contenedor">
        <div id="encabezado">
            <h1>Sistema de Gestión Odontológica</h1>
        </div>
        <form action="index.php?accion=ingresar" method="post" id="formulario">
            <h3>Iniciar Sesión</h3>
            <hr>
            <select id="clase" name="clase">
                <option value="-1" selected="selected">---Selecione su rol</option>
                <option value="1">Médico</option>
                <option value="2">Paciente</option>
                <option value="3">Administrador</option>
            </select><br><br>
            Identificación<br>
            <input type="number" name="identificacion" required><br><br>
            Contraseña<br>
            <input type="password" name="contrasena" required><br><br>
            <input type="submit" value="Ingresar"><br><br>
            <hr>
        </form>
    </div>
</body>
</html>
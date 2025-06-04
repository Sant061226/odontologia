<!DOCTYPE html>
<html>

<head>
    <title>Sistema de Gestión Odontológica</title>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
</head>

<body>
    <div id="contenedor">
        <div id="encabezado">
            <h1>Sistema de Gestión Odontológica</h1>
        </div>
        <ul id="menu">
            <li><a href="index.php?accion=inicio">Inicio</a></li>
            <?php if ($_SESSION['rol'] == 1): ?>
                <li class="activa"><a href="index.php?accion=asignar">Asignar Cita</a> </li>
                <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
                <li><a href="index.php?accion=tratamientos">Tratamientos</a></li>
            <?php elseif ($_SESSION['rol'] == 2): ?>
                <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
                <li><a href="index.php?accion=cancelar">Cancelar Cita</a></li>
                <li><a href="index.php?accion=tratamientos">Mis Tratamientos</a></li>
            <?php elseif ($_SESSION['rol'] == 3): ?>
                <li class="activa"><a href="index.php?accion=asignar">Asignar Cita</a> </li>
                <li><a href="index.php?accion=consultar">Consultar Cita</a> </li>
                <li><a href="index.php?accion=cancelar">Cancelar Cita</a> </li>
                <li><a href="index.php?accion=tratamientos">Tratamientos</a> </li>
                <li><a href="index.php?accion=consultorio">Consultorios</a> </li>
                <li><a href="index.php?accion=medicos">Medicos</a> </li>
            <?php endif; ?>
            <li><a href="index.php?accion=logout">Cerrar sesión</a></li>
        </ul>
        <div id="contenido">
            <h2>Título de página</h2>
            <p>Contenido de la página</p>
        </div>
    </div>
</body>

</html>
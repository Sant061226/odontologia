<!DOCTYPE html>
<html>

<head>
    <title>Consultar Médicos</title>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <link href="Vista/jquery/jquery-ui-1.14.1/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="Vista/jquery/jquery.js"></script>
    <script src="Vista/jquery/jquery-ui-1.14.1/jquery-ui.js" type="text/javascript"></script>
    <script src="Vista/js/script.js" type="text/javascript"></script>

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
                <li><a href="index.php?accion=pacientes">Pacientes</a> </li>
                <li><a href="index.php?accion=medicos">Medicos</a> </li>
            <?php endif; ?>
            <li><a href="index.php?accion=logout">Cerrar sesión</a></li>
        </ul>
        <div id="contenido">
            <h2>Consultar Médicos</h2>
            <table>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acciones</th>
                </tr>
                <?php while ($medico = $result->fetch_object()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($medico->MedIdentificacion); ?></td>
                        <td><?php echo htmlspecialchars($medico->MedNombres); ?></td>
                        <td><?php echo htmlspecialchars($medico->MedApellidos); ?></td>
                        <td>
                            <a href="#" onclick="mostrarModal('<?php echo htmlspecialchars($medico->MedIdentificacion); ?>','<?php echo htmlspecialchars($medico->MedNombres); ?>','<?php echo htmlspecialchars($medico->MedApellidos); ?>');return false;">Editar</a>
                            |
                            <a href="index.php?accion=eliminarMedico&id=<?php echo $medico->MedIdentificacion; ?>" onclick="return confirm('¿Seguro que deseas eliminar este médico?');">Eliminar</a>
                        </td>
                    </tr>
                    <td colspan="2">
                        <div id="paciente"></div>
                    </td>
                <?php endwhile; ?>
            </table>
            <input type="button" name="ingMedico" id="ingMedico" value="Ingresar Medico" onclick="mostrarFormularioMed()">
        </div>
        <div id="frmEditarMedico" title="Editar medico">
            <form id="EditarMedico" method="post">
                <table>
                    <tr>
                        <td>Identificación</td>
                        <td><input type="text" name="MedIdentificacion" id="editMedIdentificacion" readonly></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><input type="text" name="MedNombres" id="editMedNombres" required></td>
                    </tr>
                    <tr>
                        <td>Apellido</td>
                        <td><input type="text" name="MedApellidos" id="editMedApellidos" required></td>
                    </tr>
                    <tr>
                        <td>Nueva Contraseña</td>
                        <td><input type="password" name="MedContrasena" id="editMedContrasenan ty|12" required></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div id="frminsertarMedico" title="Agregar medico">
        <form id="insertarMedico" method="post">
            <table>
                <tr>
                    <td>Identificación</td>
                    <td><input type="text" name="MedIdentificacion" required></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" name="MedNombres" required></td>
                </tr>
                <tr>
                    <td>Apellido</td>
                    <td><input type="text" name="MedApellidos" required></td>
                </tr>
                <tr>

                    <td>Crear contraseña</td>

                    <td><input type="password" name="MedContrasena"

                            id="MedContrasena"></td>
                </tr>
            </table>
        </form>
    </div>
    </div>
</body>

</html>
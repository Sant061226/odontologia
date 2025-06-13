<!DOCTYPE html>
<html>

<head>
    <title>Asignar Cita</title>
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
            <h2>Pacientes Registrados</h2>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha Nacimiento</th>
                    <th>Sexo</th>
                    <th>Correo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                <?php while ($paciente = $result->fetch_object()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($paciente->PacIdentificacion); ?></td>
                        <td><?php echo htmlspecialchars($paciente->PacNombres); ?></td>
                        <td><?php echo htmlspecialchars($paciente->PacApellidos); ?></td>
                        <td><?php echo htmlspecialchars($paciente->PacFechaNacimiento); ?></td>
                        <td><?php echo htmlspecialchars($paciente->PacSexo); ?></td>
                        <td><?php echo htmlspecialchars($paciente->PacCorreo); ?></td>
                        <td>
                            <a href="" onclick="mostrarModalPac('<?php echo htmlspecialchars($paciente->PacIdentificacion); ?>','<?php echo htmlspecialchars($paciente->PacNombres); ?>','<?php echo htmlspecialchars($paciente->PacApellidos); ?>','<?php echo htmlspecialchars($paciente->PacFechaNacimiento); ?>','<?php echo htmlspecialchars($paciente->PacSexo); ?>','<?php echo htmlspecialchars($paciente->PacCorreo); ?>');return false;">Editar</a>

                        </td>
                        <td>
                            <a href="" onclick="eliminarPaciente('<?php echo $paciente->PacIdentificacion; ?>');return false;">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <input type="button" name="ingPaciente" id="ingPaciente" value="Ingresar Paciente" onclick="mostrarFormulario1()">
        </div>
        <div id="frmPaciente1" title="Agregar Nuevo Paciente">
            <form id="agregarPaciente1">
                <table>
                    <tr>
                        <td>Documento</td>
                        <td><input type="text" name="PacDocumento1" id="PacDocumento1" required></td>
                    </tr>
                    <tr>
                        <td>Nombres</td>
                        <td><input type="text" name="PacNombres1" id="PacNombres1" required></td>
                    </tr>
                    <tr>
                        <td>Apellidos</td>
                        <td><input type="text" name="PacApellidos1" id="PacApellidos1" required></td>
                    </tr>
                    <tr>
                        <td>Fecha de Nacimiento</td>
                        <td><input type="date" name="PacNacimiento1" id="PacNacimiento1" required></td>
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td>
                            <select id="PacSexo1" name="PacSexo1" required>
                                <option value="">--Seleccione el sexo---</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td><input type="mail" name="PacCorreo1" id="PacCorreo1" required></td>
                    </tr>
                    <tr>
                        <td>Crear contraseña</td>
                        <td><input type="password" name="PacContrasena1" id="PacContrasena1" required></td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="frmPaciente2" title="Editar Paciente">
            <form id="editarPaciente">
                <input type="hidden" name="PacDocumento" id="editPacDocumento">
                <table>
                    <tr>
                        <td>Nombres</td>
                        <td><input type="text" name="PacNombres" id="editPacNombres" required></td>
                    </tr>
                    <tr>
                        <td>Apellidos</td>
                        <td><input type="text" name="PacApellidos" id="editPacApellidos" required></td>
                    </tr>
                    <tr>
                        <td>Fecha de Nacimiento</td>
                        <td><input type="date" name="PacFechaNacimiento" id="editPacFechaNacimiento" required></td>
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td>
                            <select name="PacSexo" id="editPacSexo" required>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td><input type="mail" name="PacCorreo" id="editPacCorreo" required></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>
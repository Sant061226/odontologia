<!DOCTYPE html>
<html>

<head>
    <title>Consultar Cita</title>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <link href="Vista/jquery/jquery-ui-1.14.1/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="Vista/jquery/jquery.js"></script>
    <script src="Vista/jquery/jquery-ui-1.14.1/jquery-ui.js" type="text/javascript"></script>
    <script src="Vista/js/script.js" type="text/javascript"></script>
    <script>
    </script>
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
        <?php if ($_SESSION['rol'] == 3): ?>
            <div id="contenido">
                <h2>Consultar Cita</h2>
                <form action="index.php?accion=consultarCita" method="post" id="frmconsultar">
                    <table>
                        <tr>
                            <td>Documento del Paciente</td>
                            <td><input type="text" name="consultarDocumento"
                                    id="consultarDocumento"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="button" name="consultarConsultar"
                                    value="Consultar" id="consultarConsultar" onclick="consultarCita()"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="paciente2"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Descargar excel con todas las citas asignadas</td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="button" name="consultarConsultar"
                                    value="Descargar" id="consultarConsultar" onclick="consultarCita()"></td>
                        </tr>
                    </table>
                </form>
            </div>
        <?php elseif ($_SESSION['rol'] == 1): ?>
            <div id="contenido">
                <h2>Citas asignadas</h2>
                <form action="index.php?accion=consultarCita" method="post" id="frmconsultar">
                    <p>Para consultar sus citas, por favor haga clic en el botón a continuación.</p>
                    <button type="button" onclick="consultarCitaMedico()">Consultar</button>
                    <div id="paciente2"></div>
                </form>
            </div>
        <?php elseif ($_SESSION['rol'] == 2): ?>
            <div id="contenido">
                <h2>Mis citas</h2>
                <form action="index.php?accion=consultarCita" method="post" id="frmconsultar">
                    <p>Para consultar sus citas, por favor haga clic en el botón a continuación.</p>
                    <button type="button" onclick="consultarCitaPaciente()">Consultar</button>
                    <div id="paciente2"></div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
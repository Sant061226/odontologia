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
                <li><a href="index.php?accion=consultar">Consultar Citas</a></li>
                <li><a href="index.php?accion=tratamientos">Tratamientos</a></li>
            <?php elseif ($_SESSION['rol'] == 2): ?>
                <li><a href="index.php?accion=consultar">Consultar Citas</a></li>
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
                <h2>Consultar Tratamientos</h2>
                <form id="frmasignar" action="index.php?accion=consultarTratamientos" method="post">
                    <table>
                        <tr>
                            <td>Documento del paciente</td>
                            <td><input type="text" name="asignarDocumento" id="asignarDocumento" required></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="button" value="Consultar" name="asignarConsultar"
                                    id="asignarConsultar" onclick="consultarTratamiento()" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="paciente"></div>
                            </td>
                        </tr>
                        <tr>
                    </table>
                </form>
                <div id="frmTratamiento" title="Agregar Nuevo Tratamiento">
                    <form id="agregarTratamiento">
                        <table>
                            <tr>
                                <td>Documento</td>
                                <td><input type="text" name="PacDocumento" id="PacDocumento" readonly></td>
                            </tr>
                            <tr>
                                <td>Fecha de asignación</td>
                                <td><input type="date" name="TraFechaAsignado" id="TraFechaAsignado"></td>
                            </tr>
                            <tr>
                                <td>Descripción</td>
                                <td><input type="text" name="TraDescripcion" id="TraDescripcion"></td>
                            </tr>
                            <tr>
                                <td>Fecha de inicio tratamiento</td>
                                <td><input type="date" name="TraFechaInicio" id="TraFechaInicio"></td>
                            </tr>
                            <tr>
                                <td>Fecha de fin tratamiento</td>
                                <td><input type="date" name="TraFechaFin" id="TraFechaFin"></td>
                            </tr>
                            <tr>
                                <td>Observaciones</td>
                                <td><input type="text" name="TraObservaciones" id="TraObservaciones"></td>
                            </tr>
                        </table>
                    </form>
                    <div id="frmEditarTratamiento" title="Editar Tratamiento">
                        <form id="editarTratamiento" method="post" action="index.php?accion=EditarTratamientos">
                            <input type="hidden" name="TraNumero" id="editTraNumero">
                            <table>
                                <tr>
                                    <td>Documento</td>
                                    <td><input type="text" name="PacDocumento" id="editPacDocumento"></td>
                                </tr>
                                <tr>
                                    <td>Fecha de asignación</td>
                                    <td><input type="date" name="TraFechaAsignado" id="editTraFechaAsignado"></td>
                                </tr>
                                <tr>
                                    <td>Descripción</td>
                                    <td><input type="text" name="TraDescripcion" id="editTraDescripcion"></td>
                                </tr>
                                <tr>
                                    <td>Fecha de inicio</td>
                                    <td><input type="date" name="TraFechaInicio" id="editTraFechaInicio"></td>
                                </tr>
                                <tr>
                                    <td>Fecha de fin</td>
                                    <td><input type="date" name="TraFechaFin" id="editTraFechaFin"></td>
                                </tr>
                                <tr>
                                    <td>Observaciones</td>
                                    <td><input type="text" name="TraObservaciones" id="editTraObservaciones"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        <?php elseif ($_SESSION['rol'] == 1): ?>
            <div id="contenido">
                <h2>Consultar Tratamientos</h2>
                <form id="frmasignar" action="index.php?accion=consultarTratamientos" method="post">
                    <table>
                        <tr>
                            <td>Documento del paciente</td>
                            <td><input type="text" name="asignarDocumento" id="asignarDocumento" required></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="button" value="Consultar" name="asignarConsultar"
                                    id="asignarConsultar" onclick="consultarTratamiento()" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="paciente"></div>
                            </td>
                        </tr>
                        <tr>
                    </table>
                </form>
                <div id="frmTratamiento" title="Agregar Nuevo Tratamiento">
                    <form id="agregarTratamiento">
                        <table>
                            <tr>
                                <td>Documento</td>
                                <td><input type="text" name="PacDocumento" id="PacDocumento" readonly></td>
                            </tr>
                            <tr>
                                <td>Fecha de asignación</td>
                                <td><input type="date" name="TraFechaAsignado" id="TraFechaAsignado"></td>
                            </tr>
                            <tr>
                                <td>Descripción</td>
                                <td><input type="text" name="TraDescripcion" id="TraDescripcion"></td>
                            </tr>
                            <tr>
                                <td>Fecha de inicio tratamiento</td>
                                <td><input type="date" name="TraFechaInicio" id="TraFechaInicio"></td>
                            </tr>
                            <tr>
                                <td>Fecha de fin tratamiento</td>
                                <td><input type="date" name="TraFechaFin" id="TraFechaFin"></td>
                            </tr>
                            <tr>
                                <td>Observaciones</td>
                                <td><input type="text" name="TraObservaciones" id="TraObservaciones"></td>
                            </tr>
                        </table>
                    </form>
                    <div id="frmEditarTratamiento" title="Editar Tratamiento">
                        <form id="editarTratamiento" method="post" action="index.php?accion=EditarTratamientos">
                            <input type="hidden" name="TraNumero" id="editTraNumero">
                            <table>
                                <tr>
                                    <td>Documento</td>
                                    <td><input type="text" name="PacDocumento" id="editPacDocumento"></td>
                                </tr>
                                <tr>
                                    <td>Fecha de asignación</td>
                                    <td><input type="date" name="TraFechaAsignado" id="editTraFechaAsignado"></td>
                                </tr>
                                <tr>
                                    <td>Descripción</td>
                                    <td><input type="text" name="TraDescripcion" id="editTraDescripcion"></td>
                                </tr>
                                <tr>
                                    <td>Fecha de inicio</td>
                                    <td><input type="date" name="TraFechaInicio" id="editTraFechaInicio"></td>
                                </tr>
                                <tr>
                                    <td>Fecha de fin</td>
                                    <td><input type="date" name="TraFechaFin" id="editTraFechaFin"></td>
                                </tr>
                                <tr>
                                    <td>Observaciones</td>
                                    <td><input type="text" name="TraObservaciones" id="editTraObservaciones"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        <?php elseif ($_SESSION['rol'] == 2): ?>
            <div id="contenido">
                <h2>Consultar Tratamientos</h2>
                <form id="frmasignar" action="index.php?accion=consultarTratamientos" method="post">
                    <p>Para visulizar sus tratamientos, por favor haga clic en el botón a continuación.</p>
                    <button type="button" onclick="consultarTratamientoPaciente()">Consultar</button>
                    <div id="paciente"></div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
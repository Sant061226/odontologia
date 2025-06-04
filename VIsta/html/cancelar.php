<!DOCTYPE html>
<html>

<head>
    <title>Cancelar Cita</title>
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
                <li><a href="index.php?accion=medicos">Medicos</a> </li>
            <?php endif; ?>
            <li><a href="index.php?accion=logout">Cerrar sesión</a></li>
        </ul>
        <?php if ($_SESSION['rol'] == 3): ?>
            <div id="contenido">
                <h2>Cancelar Cita</h2>
                <form action="index.php?accion=cancelarCita" method="post"
                    id="frmcancelar">
                    <table>
                        <tr>
                            <td>Documento del Paciente </td>

                            <td><input type="text" name="cancelarDocumento"

                                    id="cancelarDocumento"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="button" value="Consultar"
                                    onclick="cancelarCita()"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="paciente3"></div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        <?php elseif ($_SESSION['rol'] == 2): ?>
                <div id="contenido">
                <h2>Cancelar Cita</h2>
                <p>Para canselar sus citas, por favor haga clic en el botón a continuación.</p>
                <button type="button" onclick="cancelarCitaPaciente()">Consultar mis citas</button>
                <div id="paciente3"></div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
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
            <li><a href="index.php">inicio</a> </li>
            <li><a href="index.php?accion=asignar">Asignar</a> </li>
            <li><a href="index.php?accion=consultar">Consultar Cita</a></li>
            <li><a href="index.php?accion=cancelar">Cancelar Cita</a> </li>
            <li class="activa"><a href="index.php?accion=tratamientos">Tratamientos</a> </li>

        </ul>
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
            </div>
        </div>
</body>

</html>
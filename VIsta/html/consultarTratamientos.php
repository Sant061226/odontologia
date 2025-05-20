<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <title>Asignar Cita</title>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <link href="Vista/jquery/jquery-ui-1.14.1/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="Vista/jquery/jquery.js"></script>
    <script src="Vista/jquery/jquery-ui-1.14.1/jquery-ui.js" type="text/javascript"></script>
    <script src="Vista/js/script.js" type="text/javascript"></script>
    <script>
    </script>
</head>

<body>
    <?php
    if ($result->num_rows > 0) {
        echo "<!--EXISTE-->";
    ?>
        <table>
            <tr>
                <th>
                    <h2>Paciente</h2>
                </th>
            </tr>
            <tr>
                <th>Documento</th>
                <th>Nombre Completo</th>
                <th>Sexo</th>
                <th>Fecha Nacimiento</th>
            </tr>
            <?php
            while ($fila = $result->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $fila->PacIdentificacion; ?></td>
                    <td><?php echo $fila->PacNombres . " " . $fila->PacApellidos; ?></td>
                    <td><?php echo $fila->PacSexo; ?></td>
                    <td><?php echo $fila->PacFechaNacimiento; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
    ?>
        <p>El paciente no existe en la base de datos.</p>
        <input type="button" name="ingPaciente" id="ingPaciente" value="Ingresar Paciente" onclick="mostrarFormulario()">
    <?php
    }
    ?>

    <?php
    if ($resultado->num_rows > 0) {
    ?>
        <table>
            <tr>
                <th>
                    <h2>Tratamientos</h2>
                </th>
            </tr>
            <tr>
                <th>Descripción</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Observaciones</th>
            </tr>
            <?php
            while ($fila = $resultado->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $fila->TraDescripcion; ?></td>
                    <td><?php echo $fila->TraFechaInicio; ?></td>
                    <td><?php echo $fila->TraFechaFin; ?></td>
                    <td><?php echo $fila->TraObservaciones; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
    ?>
        <p>El paciente no tiene tratamientos registrados.</p>
        <input type="button" name="agregarTratamiento" id="agregarTratamiento" value="Ingresar Tratamiento" onclick="mostrarFormularioTrat()">
    <?php
    }
    ?>
    <div id="frmTratamiento" title="Agregar Nuevo Tratamiento">
        <form id="agregarTratamiento">
            <table>
                <tr>
                    <td>Documento</td>

                    <td><input type="text" name="PacDocumento"

                            id="PacDocumento"></td>
                </tr>
                <tr>

                    <td>Fecha de asignación</td>

                    <td><input type="date" name="fechasig"

                            id="fechasig"></td>
                </tr>
                <tr>

                    <td>Descripción</td>

                    <td><input type="text" name="desc"

                            id="desc"></td>
                </tr>
                <tr>

                    <td>Fecha de inicio tratamiento</td>

                    <td><input type="date" name="fechin"

                            id="fechin"></td>
                </tr>
                <tr>

                    <td>Fecha de fin tratamiento</td>

                    <td><input type="date" name="fecfin"

                            id="fecfin"></td>
                </tr>
                <tr>

                    <td>Observaciones</td>

                    <td><input type="text" name="obs"

                            id="obs"></td>
                </tr>
            </table>
        </form>
    </div>
    </div>
</body>

</html>
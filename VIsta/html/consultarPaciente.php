<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    if ($result->num_rows > 0) {
        echo "<!--EXISTE-->";
    ?>
        <table>
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
</body>
</html>
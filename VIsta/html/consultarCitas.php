<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>

<body>
    <?php
    if ($result->num_rows > 0) {
    ?>
        <table>
            <tr>
                <th>Número</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Paciente</th>
                <th>Medico</th>
                <th>Consultorio</th>
                <th>Estado</th>
                <th>Observaciones</th>
            </tr>
            <?php
            while ($fila = $result->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $fila->CitNumero; ?></td>
                    <td><?php echo $fila->CitFecha; ?></td>
                    <td><?php echo $fila->CitHora; ?></td>
                    <td><?php echo $fila->CitPaciente; ?></td>
                    <td><?php echo $fila->CitMedico; ?></td>
                    <td><?php echo $fila->CitConsultorio; ?></td>
                    <td><?php echo $fila->CitEstado; ?></td>
                    <td><?php echo $fila->CitObservaciones; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
    ?>
        <p>El paciente no tiene citas asignadas</p>
    <?php
    }
    ?>
</body>
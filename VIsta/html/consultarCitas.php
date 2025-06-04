<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>

</head>

<body>
<?php if ($_SESSION['rol'] == 3): ?>
    <?php
    if ($result->num_rows > 0) {
    ?>
        <table>
            <tr>
                <th>Número</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
            <?php
            while ($fila = $result->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $fila->CitNumero; ?></td>
                    <td><?php echo $fila->CitFecha; ?></td>
                    <td><?php echo $fila->CitHora; ?></td>
                    </td>
                    <td><a href="index.php?accion=verCita&numero=<?php echo $fila->CitNumero;
                                                                    ?>">Ver</a></td>
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
<?php elseif ($_SESSION['rol'] == 1): ?>
    <?php
        if ($result->num_rows > 0) {
    ?>
        <table>
            <tr>
                <th>Número</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
            <?php
            while ($fila = $result->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $fila->CitNumero; ?></td>
                    <td><?php echo $fila->CitFecha; ?></td>
                    <td><?php echo $fila->CitHora; ?></td>
                    </td>
                    <td><a href="index.php?accion=verCita&numero=<?php echo $fila->CitNumero;
                                                                    ?>">Ver</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php
    } else {
    ?>
        <p>El medico no tiene citas asignadas</p>
    <?php
    }
    ?>
<?php elseif ($_SESSION['rol'] == 2): ?>
    <?php
        if ($result->num_rows > 0) {
    ?>
        <table>
            <tr>
                <th>Número</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
            <?php
            while ($fila = $result->fetch_object()) {
            ?>
                <tr>
                    <td><?php echo $fila->CitNumero; ?></td>
                    <td><?php echo $fila->CitFecha; ?></td>
                    <td><?php echo $fila->CitHora; ?></td>
                    </td>
                    <td><a href="index.php?accion=verCita&numero=<?php echo $fila->CitNumero;
                                                                    ?>">Ver</a></td>
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
<?php endif; ?>
</body>
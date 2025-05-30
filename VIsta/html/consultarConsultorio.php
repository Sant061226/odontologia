<head>
    <meta charset="UTF-8">
    <title>Ver Consultorios</title>
</head>
<?php
require_once __DIR__ . '/../../Modelo/GestorCita.php';
$gestorCita = new GestorCita();

if ($result->num_rows > 0) {
    ?>
    <table class="tabla-paciente">
        <tr>
            <th>Número</th>
            <th>Nombre</th>
            <th>Acción</th>
        </tr>
        <?php
        while ($fila = $result->fetch_object()) {
            ?>
            <tr>
                <td><?php echo $fila->ConNumero; ?></td>
                <td><?php echo $fila->ConNombre; ?></td>
                <td>
                    <a href="index.php?accion=eliminarConsultorio&numero=<?php echo $fila->ConNumero; ?>"
                        onclick="return confirm('¿Seguro que desea eliminar este consultorio?')">Eliminar</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} else {
    ?>
    <p>No hay consultorios registrados</p>
    <?php
}
?>
</body>

</html>
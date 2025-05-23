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
               <th>Numero de tratamiento</th>
               <th>Descripción</th>
               <th>Fecha Inicio</th>
               <th>Fecha Fin</th>
               <th>Observaciones</th>
               <th>Editar</th>
               <th>Eliminar</th>

           </tr>
           <?php
            while ($fila = $resultado->fetch_object()) {
            ?>
               <tr>
                   <td><?php echo $fila->TraNumero; ?></td>
                   <td><?php echo $fila->TraDescripcion; ?></td>
                   <td><?php echo $fila->TraFechaInicio; ?></td>
                   <td><?php echo $fila->TraFechaFin; ?></td>
                   <td><?php echo $fila->TraObservaciones; ?></td>
                   <td><a href="#" onclick="confirmarEditarTrat(<?php echo $fila->TraNumero; ?>)">Editar</a></td>
                   <td><a href="#" onclick="confirmarCancelarTrat(<?php echo $fila->TraNumero;
                                                                    ?>)">Cancelar</a></td>

               </tr>
           <?php
            }
            ?>
       </table>
       <input type="button" name="agregarTratamiento" id="agregarTratamiento" value="Agregar Tratamiento" onclick="mostrarFormularioTrat()">

   <?php
    } else {
    ?>
       <p>El paciente no tiene tratamientos registrados.</p>
       <input type="button" name="agregarTratamiento" id="agregarTratamiento" value="Ingresar Tratamiento" onclick="mostrarFormularioTrat()">
   <?php
    }
    ?>
<?php
class GestorTratamientos
{
    public function agregarTratamiento(Tratamientos $tratamiento)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $identificacion = $tratamiento->obtenerIdentificacion();
        $fechasig = $tratamiento->obtenerFechasignacion();
        $descripcion = $tratamiento->obtenerDescripcion();
        $fechaini = $tratamiento->obtenerFechaInicio();
        $fechafin = $tratamiento->obtenerFechaFin();
        $observaciones = $tratamiento->obtenerObservaciones();
        echo "<script>alert($descripcion);</script>";
        echo $identificacion, $fechasig;
        $sql = "INSERT INTO `tratamientos` (`TraNumero`, `TraFechaAsignado`, `TraDescripcion`, `TraFechaInicio`, `TraFechaFin`, `TraObservaciones`, `TraPaciente`) VALUES (NULL, '$fechasig', '$descripcion', '$fechaini', '$fechafin', '$observaciones', '$identificacion')";
        $conexion->consulta($sql);
        $tratamientoId = $conexion->obtenerCitaId();
        $conexion->cerrar();
        return $tratamientoId;
    }
    public function consultarTratamiento($doc)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT * FROM Pacientes WHERE PacIdentificacion = '$doc' ";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        return $result;
    }
    public function consultarTratamientosPorId($doc)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT TraFechaAsignado, TraDescripcion, TraFechaInicio, TraFechaFin, TraObservaciones 
            FROM tratamientos 
            WHERE TraPaciente = '$doc'";
        $conexion->consulta($sql);
        $resultado = $conexion->obtenerResult();
        $conexion->cerrar();
        return $resultado;
    }
    public function consultarTratamientosPorDocumento($doc)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT TraFechaAsignado, TraDescripcion, TraFechaInicio, TraFechaFin, TraObservaciones 
            FROM tratamientos 
            WHERE TraPaciente = '$doc'";
        $conexion->consulta($sql);
        $resultado = $conexion->obtenerResult();
        $conexion->cerrar();
        return $resultado;
    }
}

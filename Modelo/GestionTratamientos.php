<?php
class GestorTratamientos
{
    public function agregarTratamiento(Tratamientos $tratamientos)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $identificacion = $tratamientos->obtenerIdentificacion();
        $fechasig = $tratamientos->obtenerFechasignacion();
        $descripcion = $tratamientos->obtenerDescripcion();
        $fechaini = $tratamientos->obtenerFechaInicio();
        $fechafin = $tratamientos->obtenerFechaFin();
        $observaciones = $tratamientos->obtenerObservaciones();
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
        $sql = "SELECT TraNumero, TraFechaAsignado, TraDescripcion, TraFechaInicio, TraFechaFin, TraObservaciones 
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
        $sql = "SELECT TraNumero, TraFechaAsignado, TraDescripcion, TraFechaInicio, TraFechaFin, TraObservaciones 
            FROM tratamientos 
            WHERE TraPaciente = '$doc'";
        $conexion->consulta($sql);
        $resultado = $conexion->obtenerResult();
        $conexion->cerrar();
        return $resultado;
    }
    public function cancelarTratamiento($trata)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "DELETE FROM tratamientos WHERE TraNumero = $trata";
        $conexion->consulta($sql);
        $filasAfectadas = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $filasAfectadas;
    }
    public function EditarTratamiento(Tratamientos $tratamiento)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $id = $tratamiento->obtenerNumero();
        $fechasig = $tratamiento->obtenerFechasignacion();
        $descripcion = $tratamiento->obtenerDescripcion();
        $fechaini = $tratamiento->obtenerFechaInicio();
        $fechafin = $tratamiento->obtenerFechaFin();
        $observaciones = $tratamiento->obtenerObservaciones();
        $sql = "UPDATE tratamientos SET 
        TraFechaAsignado = '$fechasig', 
        TraDescripcion = '$descripcion', 
        TraFechaInicio = '$fechaini', 
        TraFechaFin = '$fechafin', 
        TraObservaciones = '$observaciones'
        WHERE TraNumero = '$id'";
        $conexion->consulta($sql);
        $filasAfectadas = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $filasAfectadas;
    }
}

<?php
class GestorTratamientos
{
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
        $sql = "INSERT INTO tratamientos 
        (TraPaciente, TraFechaAsignado, TraDescripcion, TraFechaInicio, TraFechaFin, TraObservaciones) 
        VALUES 
        ('$identificacion', '$fechasig', '$descripcion', '$fechaini', '$fechafin', '$observaciones')";
        $conexion->consulta($sql);
        $filasAfectadas = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $filasAfectadas;
    }
}
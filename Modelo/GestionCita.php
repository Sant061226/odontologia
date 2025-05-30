<?php
class GestorCita
{
    public function agregarCita(Cita $cita)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $paciente = $cita->obtenerPaciente();
        $medico = $cita->obtenerMedico();
        $fecha = $cita->obtenerFecha();
        $consultorio = $cita->obtenerConsultorio();
        $hora = $cita->obtenerHora();
        $estado = $cita->obtenerEstado();
        $observaciones = $cita->obtenerObservaciones();
        $sql = "INSERT INTO Citas VALUES ( null,'$fecha','$hora',
'$paciente','$medico','$consultorio','$estado','$observaciones')";
        $conexion->consulta($sql);
        $citaId = $conexion->obtenerCitaId();
        $conexion->cerrar();
        return $citaId;
    }
    public function consultarCitasPorDocumento($doc)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT * FROM citas "
            . "WHERE CitPaciente = '$doc' "
            . " AND CitEstado = 'Solicitada' ";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        return $result;
    }
    public function consultarPaciente($doc)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT * FROM Pacientes WHERE PacIdentificacion = '$doc' ";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        return $result;
    }
    public function consultarCitaPorId($id)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT pacientes.* , medicos.*, consultorios.*, citas.*"
            . "FROM Pacientes as pacientes, Medicos as medicos, Consultorios
as consultorios ,citas "
            . "WHERE citas.CitPaciente = pacientes.PacIdentificacion "
            . " AND citas.CitMedico = medicos.MedIdentificacion "
            . " AND citas.CitNumero = $id";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        return $result;
    }
    public function agregarPaciente(Paciente $paciente)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $identificacion = $paciente->obtenerIdentificacion();
        $nombres = $paciente->obtenerNombres();
        $apellidos = $paciente->obtenerApellidos();
        $fechaNacimiento = $paciente->obtenerFechaNacimiento();
        $sexo = $paciente->obtenerSexo();
        $contrasena = $paciente->obtenerContrasena();
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $sql = "INSERT INTO Pacientes (PacIdentificacion, PacNombres, PacApellidos, PacFechaNacimiento, PacSexo, PacContrasena)
                VALUES ('$identificacion','$nombres','$apellidos','$fechaNacimiento','$sexo','$hash')";
        $conexion->consulta($sql);
        $filasAfectadas = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $filasAfectadas;
    }
    public function consultarMedicos()
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT * FROM Medicos ";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        return $result;
    }
    public function consultarHorasDisponibles($medico, $fecha)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT hora FROM horas WHERE hora NOT IN "
            . "( SELECT CitHora FROM citas WHERE CitMedico = '$medico' AND
CitFecha = '$fecha'"
            . " AND CitEstado = 'Solicitada') ";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        return $result;
    }
    public function cancelarCita($cita)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "UPDATE citas SET CitEstado = 'Cancelada' "
            . " WHERE CitNumero = $cita ";
        $conexion->consulta($sql);
        $filasAfectadas = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $filasAfectadas;
    }
    public function consultarConsultorios()
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT ConNumero, ConNombre FROM consultorios";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        return $result;
    }
    public function tieneCitasAgendadas($conNumero)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT COUNT(*) as total FROM citas WHERE CitConsultorio = $conNumero AND CitEstado = 'Solicitada'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        $row = $result->fetch_object();
        return $row->total > 0;
    }

    public function eliminarConsultorio($conNumero)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "DELETE FROM consultorios WHERE ConNumero = $conNumero";
        $conexion->consulta($sql);
        $conexion->cerrar();
    }
    public function consultarConsultorioPorNumero($numero)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT * FROM consultorios WHERE ConNumero = $numero";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        return $result->fetch_object();
    }

    public function actualizarConsultorio($numero, $nombre)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "UPDATE consultorios SET ConNombre = '$nombre' WHERE ConNumero = $numero";
        $conexion->consulta($sql);
        $conexion->cerrar();
    }
    public function agregarConsultorio($numero, $nombre)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "INSERT INTO consultorios (ConNumero, ConNombre) VALUES ($numero, '$nombre')";
        $conexion->consulta($sql);
        $conexion->cerrar();
    }
    public function existeConsultorioPorNumero($numero)
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT COUNT(*) as total FROM consultorios WHERE ConNumero = '$numero'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        $row = $result->fetch_object();
        return $row->total > 0;
    }
}

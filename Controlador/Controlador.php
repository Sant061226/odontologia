<?php
class Controlador
{
    public function verPagina($ruta)
    {
        require_once $ruta;
    }
    public function agregarCita($doc, $med, $fec, $hor, $con)
    {
        $cita = new Cita(
            null,
            $fec,
            $hor,
            $doc,
            $med,
            $con,
            "Solicitada",
            "Ninguna"
        );
        $gestorCita = new GestorCita();
        $id = $gestorCita->agregarCita($cita);
        $result = $gestorCita->consultarCitaPorId($id);
        require_once 'Vista/html/confirmarCita.php';
    }
    public function agregarTratamiento($ide, $fec, $des, $fIn, $fFin, $obs)
    {
        $tratamiento = new Tratamientos(
            null,
            $ide,
            $fec,
            $des,
            $fIn,
            $fFin,
            $obs
        );
        $gestorTratamiento = new GestorTratamientos();
        $gestorTratamiento->agregarTratamiento($tratamiento);
        $id = $gestorTratamiento->agregarTratamiento($tratamiento);
        $result = $gestorTratamiento->consultarTratamiento($id);
        $resultado = $gestorTratamiento->consultarTratamientosPorId($id);
        require_once 'Vista/html/consultarTratamientos.php';
    }
    public function consultarCitas($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitasPorDocumento($doc);
        require_once 'Vista/html/consultarCitas.php';
    }
    public function cancelarCitas($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitasPorDocumento($doc);
        require_once 'Vista/html/cancelarCitas.php';
    }
    public function cancelarTratamiento($doc)
    {
        $gestorTratamiento = new GestorTratamientos();
        $result = $gestorTratamiento->consultarTratamientosPorDocumento($doc);
        require_once 'Vista/html/consultarTratamientos.php';
    }
    public function consultarPaciente($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarPaciente($doc);
        require_once 'Vista/html/consultarPaciente.php';
    }
    public function consultarTratamiento($doc)
    {
        $tratamiento = new GestorTratamientos();
        $result = $tratamiento->consultarTratamiento($doc);
        $resultado = $tratamiento->consultarTratamientosPorDocumento($doc);
        require_once 'Vista/html/consultarTratamientos.php';
    }
    public function agregarPaciente($doc, $nom, $ape, $fec, $sex, $contr)
    {
        $paciente = new Paciente($doc, $nom, $ape, $fec, $sex, $contr);
        $gestorCita = new GestorCita();
        $registros = $gestorCita->agregarPaciente($paciente);
        if ($registros > 0) {
            echo "Se insertó el paciente con exito";
        } else {
            echo "Error al guardar el paciente";
        }
    }
    public function cargarAsignar()
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarMedicos();
        $result2 = $gestorCita->consultarConsultorios();
        require_once 'Vista/html/asignar.php';
    }
    public function consultarHorasDisponibles($medico, $fecha)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarHorasDisponibles(
            $medico,
            $fecha
        );
        require_once 'Vista/html/consultarHoras.php';
    }
    public function verCita($cita)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitaPorId($cita);
        require_once 'Vista/html/confirmarCita.php';
    }
    public function confirmarCancelarCita($cita)
    {
        $gestorCita = new GestorCita();
        $registros = $gestorCita->cancelarCita($cita);
        if ($registros > 0) {
            echo "La cita se ha cancelado con éxito";
        } else {
            echo "Hubo un error al cancelar la cita";
        }
    }
    public function confirmarCancelarTratamiento($trata)
    {
        $gestorTratamiento = new GestorTratamientos();
        $registros = $gestorTratamiento->cancelarTratamiento($trata);
        if ($registros > 0) {
            echo "El tratamiento se ha cancelado con éxito";
        } else {
            echo "Hubo un error al cancelar el tratamiento";
        }
    }
    public function editarTratamiento($num, $ide, $fec, $des, $fIn, $fFin, $obs)
    {
        $tratamiento = new Tratamientos(
            $num,
            $ide,
            $fec,
            $des,
            $fIn,
            $fFin,
            $obs
        );
        $gestorTratamiento = new GestorTratamientos();
        $gestorTratamiento->EditarTratamiento($tratamiento);

        $result = $gestorTratamiento->consultarTratamiento($ide);
        $resultado = $gestorTratamiento->consultarTratamientosPorDocumento($ide);
        require_once 'Vista/html/consultarTratamientos.php';
    }
    public function inicioSesion($identificacion, $contrasena, $rol)
    {
        session_start();
        $usuario = false;

        if ($rol == 2) { 
            require_once 'Modelo/GestionSesion.php';
            $gestionUsuarios = new GestorSesion();
            $usuario = $gestionUsuarios->verificarUsuario($identificacion, $contrasena, $rol);
            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario->PacIdentificacion;
                $_SESSION['rol'] = $rol;
                header("Location: index.php?accion=tratamientos");
                exit();
            }
        } elseif ($rol == 1) {
            require_once 'Modelo/GestionMedicos.php';
            $gestionUsuarios = new GestionMedicos();
            $usuario = $gestionUsuarios->verificarUsuario($identificacion, $contrasena, $rol);
            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario->identificacion;
                $_SESSION['rol'] = $rol;
                header("Location: index.php?accion=inicio");
                exit();
            }
        } elseif ($rol == 3) {
            header("Location: index.php?accion=consultar");
            exit();
        }
    }
}

<?php
class Controlador
{
    public function verPagina($ruta)
    {
        require_once $ruta;
    }
    public function inicioSesion($identificacion, $contrasena, $rol)
    {
        $gestionUsuarios = new GestorSesion();
        $sesion = new Sesion($identificacion, $contrasena, $rol);
        $usuario = $gestionUsuarios->verificarUsuario($sesion);
        if ($usuario) {
            if ($rol == 2) {
                $_SESSION['usuario_id'] = $usuario->PacIdentificacion;
                $_SESSION['rol'] = $rol;
                header("Location: index.php?accion=inicio");
                exit();
            } elseif ($rol == 1) {
                $_SESSION['usuario_id'] = $usuario->MedIdentificacion;
                $_SESSION['rol'] = $rol;
                header("Location: index.php?accion=inicio");
                exit();
            } elseif ($rol == 3) {
                $_SESSION['usuario_id'] = $usuario->AdIdentificacion;
                $_SESSION['rol'] = $rol;
                header("Location: index.php?accion=inicio");
                exit();
            }
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos');window.location='index.php';</script>";
        }
    }
    public function cerrarSesion()
    {
        if (isset($_SESSION['usuario_id']) && isset($_SESSION['rol'])) {
            unset($_SESSION['usuario_id']);
            unset($_SESSION['rol']);
        }
        session_destroy();
        header("Location:index.php");
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
    public function guardarCita()
    {
        $gestorCita = new GestorCita();

        // Guardar la cita normalmente
        $citaId = $gestorCita->agregarCita(
            $_POST['asignarDocumento'],
            $_POST['medico'],
            $_POST['consultorio'],
            $_POST['fecha'],
            $_POST['hora']
        );

        // Obtener correo del paciente
        $correo = $gestorCita->obtenerCorreoPaciente($_POST['asignarDocumento']);

        // Llamar al envío de correo
        require_once 'Modelo/EnviarCorreoCita.php';
        enviarCorreoCita($citaId, $correo);

        // Redirigir o mostrar mensaje
        header('Location: index.php?accion=consultarCitas&msg=ok');
        exit;
    }
    public function listarPacientes()
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarPacientes();
        require 'Vista/html/pacientes.php';
    }
    public function consultarCitas($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitasPorDocumento($doc);
        require_once 'Vista/html/consultarCitas.php';
    }
    public function consultarCitasMedico($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitasPorMedico($doc);
        require_once 'Vista/html/consultarCitas.php';
    }
    public function consultarCitasPaciente($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitasPorPaciente($doc);
        require_once 'Vista/html/consultarCitas.php';
    }
    public function cancelarCitas($doc)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarCitasPorDocumento($doc);
        require_once 'Vista/html/cancelarCitas.php';
    }
    public function cancelarCitasPacientes($doc)
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
    public function consultarTratamientoPaciente($doc)
    {
        $tratamiento = new GestorTratamientos();
        $result = $tratamiento->consultarTratamiento($doc);
        $resultado = $tratamiento->consultarTratamientosPorDocumento($doc);
        require_once 'Vista/html/consultarTratamientos.php';
    }
    public function agregarPaciente($doc, $nom, $ape, $fec, $sex, $corr, $contr)
    {
        $paciente = new Paciente($doc, $nom, $ape, $fec, $sex, $corr, $contr);
        $gestorCita = new GestorCita();
        $registros = $gestorCita->agregarPaciente($paciente);
        if ($registros > 0) {
            echo "Se insertó el paciente con exito";
        } else {
            echo "Error al guardar el paciente";
        }
    }
    public function agregarPacientes($doc, $nom, $ape, $fec, $sex, $corr, $contr)
    {
        $paciente1 = new Paciente($doc, $nom, $ape, $fec, $sex, $corr, $contr);
        $gestorCita = new GestorCita();
        $registros = $gestorCita->agregarPaciente1($paciente1);
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
    public function mostrarConsultorio($editarNumero = null)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarConsultorios();
        $consultorioEditar = null;
        if ($editarNumero) {
            $consultorioEditar = $gestorCita->consultarConsultorioPorNumero($editarNumero);
        }
        require 'Vista/html/consultorio.php';
    }
    public function eliminarConsultorio($numero)
    {
        $gestorCita = new GestorCita();
        if ($gestorCita->tieneCitasAgendadas($numero)) {
            $mensaje = "Error, No se puede eliminar consultorio.";
        } else {
            $gestorCita->eliminarConsultorio($numero);
            $mensaje = "Consultorio eliminado";
        }
        $result = $gestorCita->consultarConsultorios();
        require 'Vista/html/consultorio.php';
    }
    public function editarConsultorio($numero)
    {
        $gestorCita = new GestorCita();
        $consultorio = $gestorCita->consultarConsultorioPorNumero($numero);
        require 'Vista/html/editarConsultorio.php';
    }

    public function actualizarConsultorio($numero, $nombre)
    {
        $gestorCita = new GestorCita();
        $gestorCita->actualizarConsultorio($numero, $nombre);
        $result = $gestorCita->consultarConsultorios();
        $mensaje = "Consultorio actualizado";
        require 'Vista/html/consultorio.php';
    }
    public function agregarConsultorio($numero, $nombre)
    {
        $gestorCita = new GestorCita();
        if ($gestorCita->existeConsultorioPorNumero($numero)) {
            $mensaje = "Error, ya existe un consultorio con ese número.";
        } else {
            $gestorCita->agregarConsultorio($numero, $nombre);
            $mensaje = "Consultorio agregado";
        }
        $result = $gestorCita->consultarConsultorios();
        require 'Vista/html/consultorio.php';
    }
    public function listarMedicos()
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarMedicos();
        require 'Vista/html/medicos.php';
    }
    public function agregarMedico($doc, $nom, $ape, $contr)
    {
        $gestorCita = new GestorCita();
        $gestorCita->insertarMedico($doc, $nom, $ape, $contr);
    }
    public function editarMedico($id)
    {
        $gestorCita = new GestorCita();
        $result = $gestorCita->consultarMedicoPorId($id);
        require 'Vista/html/editarMedico.php';
    }
    public function actualizarMedico($doc, $nom, $ape, $contr)
    {
        $gestorCita = new GestorCita();
        $gestorCita->actualizarMedico($doc, $nom, $ape, $contr);
        header('Location: index.php?accion=medicos');
        exit;
    }
    public function eliminarMedico($id)
    {
        $gestorCita = new GestorCita();
        $gestorCita->eliminarMedico($id);
    }
    public function consultarMedicos()
    {
        $conexion = new Conexion();
        $conexion->abrir();
        $sql = "SELECT * FROM medicos";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResult();
        $conexion->cerrar();
        return $result;
    }
    public function actualizarPaciente($doc, $nom, $ape, $fec, $sex)
    {
        $gestorCita = new GestorCita();
        $gestorCita->actualizarPaciente($doc, $nom, $ape, $fec, $sex);
    }
    public function eliminarPaciente($id)
    {
        $gestorCita = new GestorCita();
        $gestorCita->eliminarPaciente($id);
    }
}

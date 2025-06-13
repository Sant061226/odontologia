<?php

session_start();
require_once 'Controlador/Controlador.php';
require_once 'Modelo/GestionCita.php';
require_once 'Modelo/Citas.php';
require_once 'Modelo/Paciente.php';
require_once 'Modelo/GestionTratamientos.php';
require_once 'Modelo/Tratamientos.php';
require_once 'Modelo/Conexion.php';
require_once 'Modelo/GestionSesion.php';
require_once 'Modelo/Sesion.php';
require_once 'Modelo/ExportarExcel.php';

$controlador = new Controlador();
if (isset($_GET["accion"])) {
    switch ($_GET["accion"]) {
        case 'login':
            $controlador->inicioSesion(
                $_POST["identificacion"],
                $_POST["contrasena"],
                $_POST["clase"]
            );
            break;
    }
    if ($_GET["accion"] == "logout") {
        $controlador->cerrarSesion();
    } elseif ($_GET["accion"] == "asignar") {
        $controlador->cargarAsignar();
    } elseif ($_GET["accion"] == "consultar") {
        $controlador->verPagina('Vista/html/consultar.php');
    } elseif ($_GET["accion"] == "cancelar") {
        $controlador->verPagina('Vista/html/cancelar.php');
    } elseif ($_GET["accion"] == "logout") {
        $controlador->cerrarSesion();
    } elseif ($_GET["accion"] == "tratamientos") {
        $controlador->verPagina('Vista/html/tratamientos.php');
    } elseif ($_GET["accion"] == "inicio") {
        $controlador->verPagina('Vista/html/inicio.php');
    } elseif ($_GET["accion"] == "pacientes") {
        $controlador->listarPacientes();
    } elseif ($_GET["accion"] == "guardarCita") {
        $controlador->agregarCita(
            $_POST["asignarDocumento"],
            $_POST["medico"],
            $_POST["fecha"],
            $_POST["hora"],
            $_POST["consultorio"]
        );
    } elseif ($_GET["accion"] == "guardarTratamiento") {
        $controlador->agregarTratamiento(
            $_GET["PacDocumento"],
            $_GET["TraFechaAsignado"],
            $_GET["TraDescripcion"],
            $_GET["TraFechaInicio"],
            $_GET["TraFechaFin"],
            $_GET["TraObservaciones"]
        );
    } elseif ($_GET["accion"] == "consultarCita") {
        $controlador->consultarCitas($_GET["consultarDocumento"]);
    } elseif ($_GET["accion"] == "consultarCitaMedico") {
        $controlador->consultarCitasMedico($_SESSION['usuario_id']);
    } elseif ($_GET["accion"] == "consultarCitaPaciente") {
        $controlador->consultarCitasPaciente($_SESSION['usuario_id']);
    } elseif ($_GET["accion"] == "cancelarCita") {
        $controlador->cancelarCitas($_GET["cancelarDocumento"]);
    } elseif ($_GET["accion"] == "cancelarCitaPaciente") {
        $controlador->cancelarCitasPacientes($_SESSION['usuario_id']);
    } elseif ($_GET["accion"] == "cancelarTratamiento") {
        $controlador->cancelarTratamiento($_GET["cancelarDocumento"]);
    } elseif ($_GET["accion"] == "ConsultarPaciente") {
        $controlador->consultarPaciente($_GET["documento"]);
    } elseif ($_GET["accion"] == "ingresarPaciente") {
        $controlador->agregarPaciente(
            $_GET["PacDocumento"],
            $_GET["PacNombres"],
            $_GET["PacApellidos"],
            $_GET["PacNacimiento"],
            $_GET["PacSexo"],
            $_GET["PacCorreo"],
            $_GET["PacContraseña"],
        );
    } elseif ($_GET["accion"] == "ingresarPaciente1") {
        $controlador->agregarPacientes(
            $_GET["PacDocumento1"],
            $_GET["PacNombres1"],
            $_GET["PacApellidos1"],
            $_GET["PacNacimiento1"],
            $_GET["PacSexo1"],
            $_GET["PacCorreo1"],
            $_GET["PacContraseña1"],
        );
    } elseif ($_GET["accion"] == "consultarHora") {
        $controlador->consultarHorasDisponibles($_GET["medico"], $_GET["fecha"]);
    } elseif ($_GET["accion"] == "verCita") {
        $controlador->verCita($_GET["numero"]);
    } elseif ($_GET["accion"] == "confirmarCancelar") {
        $controlador->confirmarCancelarCita($_GET["numero"]);
    } elseif ($_GET["accion"] == "confirmarCancelarTrat") {
        $controlador->confirmarCancelarTratamiento($_GET["numero"]);
    } elseif ($_GET["accion"] == "ConsultarTratamientos") {
        $controlador->consultarTratamiento($_GET["documento"]);
    } elseif ($_GET["accion"] == "ConsultarTratamientosPaciente") {
        $controlador->consultarTratamiento($_SESSION['usuario_id']);
    } elseif ($_GET["accion"] == "EditarTratamientos") {
        $controlador->editarTratamiento(
            $_POST["TraNumero"],
            $_POST["PacDocumento"],
            $_POST["TraFechaAsignado"],
            $_POST["TraDescripcion"],
            $_POST["TraFechaInicio"],
            $_POST["TraFechaFin"],
            $_POST["TraObservaciones"]
        );
    } elseif ($_GET["accion"] == "consultorio") {
        $editarNumero = isset($_GET["editar"]) ? $_GET["editar"] : null;
        $controlador->mostrarConsultorio($editarNumero);
    } elseif ($_GET["accion"] == "eliminarConsultorio") {
        $controlador->eliminarConsultorio($_GET["numero"]);
    } elseif ($_GET["accion"] == "editarConsultorio") {
        $controlador->editarConsultorio($_GET["numero"]);
    } elseif ($_GET["accion"] == "actualizarConsultorio") {
        $controlador->actualizarConsultorio($_GET["numero"], $_GET["nombre"]);
    } elseif ($_GET["accion"] == "agregarConsultorio") {
        $controlador->agregarConsultorio($_GET["numero"], $_GET["nombre"]);
    } elseif ($_GET['accion'] == 'medicos') {
        $controlador->listarMedicos();
    } elseif ($_GET['accion'] == 'agregarMedico' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $controlador->agregarMedico(
            $_POST["MedIdentificacion"],
            $_POST["MedNombres"],
            $_POST["MedApellidos"],
            $_POST["MedContrasena"]
        );
        header('Location: index.php?accion=medicos');
        exit;
    } elseif ($_GET['accion'] == 'eliminarMedico' && isset($_GET['id'])) {
        $controlador->eliminarMedico($_GET["id"]);
        header('Location: index.php?accion=medicos');
        exit;
    } elseif ($_GET['accion'] == 'editarMedico' && isset($_GET['id'])) {
        $controlador->editarMedico($_GET["id"]);
        header('Location: index.php?accion=medicos');
        exit;
    } elseif ($_GET['accion'] == 'actualizarMedico' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $controlador->actualizarMedico(
            $_POST["MedIdentificacion"],
            $_POST["MedNombres"],
            $_POST["MedApellidos"],
            $_POST["MedContrasena"]
        );
    } elseif ($_GET["accion"] == "actualizarPaciente") {
        $controlador->actualizarPaciente(
            $_POST["PacDocumento"],
            $_POST["PacNombres"],
            $_POST["PacApellidos"],
            $_POST["PacFechaNacimiento"],
            $_POST["PacCorreo"],
            $_POST["PacSexo"]
        );
        exit;
    } elseif ($_GET["accion"] == "eliminarPaciente" && isset($_GET["id"])) {
        $controlador->eliminarPaciente($_GET["id"]);
        exit;
    } elseif ($_GET["accion"] == "descargarExcelCitas") {
        require_once 'Modelo/ExportarExcel.php';
        exportarCitasExcel();
    } elseif ($_GET["accion"] == "enviarCorreoCita" && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['CitNumero']) && isset($_POST['correo_destino'])) {
        require_once 'Modelo/EnviarCorreoCita.php';
        if (enviarCorreoCita($_POST['CitNumero'], $_POST['correo_destino'])) {
            $controlador->verPagina('Vista/html/inicio.php');
        } else {
            echo "<script>alert('Error al enviar el correo'); window.location.reload();</script>";
        }
        exit;
    }
} else {
    $controlador->verPagina('Vista/html/login.php');
}

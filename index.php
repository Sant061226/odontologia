<?php
require_once 'Controlador/Controlador.php';
require_once 'Modelo/GestionCita.php';
require_once 'Modelo/Citas.php';
require_once 'Modelo/Paciente.php';
require_once 'Modelo/GestionTratamientos.php';
require_once 'Modelo/Tratamientos.php';
require_once 'Modelo/Conexion.php';
require_once 'Modelo/GestionMedicos.php';
require_once 'Modelo/Medicos.php';
require_once 'Modelo/GestionSesion.php';
$controlador = new Controlador();
if (isset($_GET["accion"])) {
    if ($_GET["accion"] == "asignar") {
        $controlador->cargarAsignar();
    } elseif ($_GET["accion"] == "consultar") {
        $controlador->verPagina('Vista/html/consultar.php');
    } if ($_GET["accion"] == "ingresar") {
        $controlador->inicioSesion(
            $_POST["identificacion"],
            $_POST["contrasena"],
            $_POST["clase"]
        );
        if ($_POST["clase"] == 1) {
            $controlador->verPagina('Vista/html/inicio.php');
        } elseif ($_POST["clase"] == 2) {
            $controlador->verPagina('Vista/html/tratamientos.php');
        } elseif ($_POST["clase"] == 3) {
            $controlador->verPagina('Vista/html/consultar.php');
        }
    } elseif ($_GET["accion"] == "cancelar") {
        $controlador->verPagina('Vista/html/cancelar.php');
    } elseif ($_GET["accion"] == "tratamientos") {
        $controlador->verPagina('Vista/html/tratamientos.php');
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
            $_POST["PacDocumento"],
            $_POST["TraFechaAsignado"],
            $_POST["TraDescripcion"],
            $_POST["TraFechaInicio"],
            $_POST["TraFechaFin"],
            $_POST["TraObservaciones"]
        );
    } elseif ($_GET["accion"] == "consultarCita") {
        $controlador->consultarCitas($_GET["consultarDocumento"]);
    } elseif ($_GET["accion"] == "cancelarCita") {
        $controlador->cancelarCitas($_GET["cancelarDocumento"]);
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
            $_GET["PacContraseña"],
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
    }
} else {
    $controlador->verPagina('Vista/html/login.php');
}

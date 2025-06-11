<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/../PHPMailer-master/src/Exception.php';

function enviarCorreoCita($citNumero, $correoDestino)
{
    // Busca los datos de la cita
    $conn = new mysqli("localhost", "root", "", "citas");
    $stmt = $conn->prepare("SELECT c.*, 
        p.PacNombres, p.PacApellidos, p.PacIdentificacion, 
        m.MedNombres, m.MedApellidos, m.MedIdentificacion, 
        con.ConNombre
        FROM citas c
        JOIN pacientes p ON c.CitPaciente = p.PacIdentificacion
        JOIN medicos m ON c.CitMedico = m.MedIdentificacion
        JOIN consultorios con ON c.CitConsultorio = con.ConNumero
        WHERE c.CitNumero = ?");
    $stmt->bind_param("i", $citNumero);
    $stmt->execute();
    $result = $stmt->get_result();
    $cita = $result->fetch_assoc();
    $stmt->close();
    $conn->close();

    if ($cita) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'saa.arevalo@gmail.com';
            $mail->Password = 'upca dgfl gafm sdxi';  
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('TUCORREO@gmail.com', 'Sistema Odontología');
            $mail->addAddress($correoDestino);

            $mail->isHTML(true);
            $mail->Subject = 'Registro de Cita';
            $mail->Body = "
                <h2>Registro de Cita</h2>
                <b>Paciente:</b> {$cita['PacNombres']} {$cita['PacApellidos']}<br>
                <b>Documento:</b> {$cita['PacIdentificacion']}<br>
                <b>Médico:</b> {$cita['MedNombres']} {$cita['MedApellidos']}<br>
                <b>Consultorio:</b> {$cita['ConNombre']}<br>
                <b>Fecha:</b> {$cita['CitFecha']}<br>
                <b>Hora:</b> {$cita['CitHora']}<br>
                <b>Estado:</b> {$cita['CitEstado']}<br>
                <b>Observaciones:</b> {$cita['CitObservaciones']}<br>
            ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    } else {
        return false;
    }
}
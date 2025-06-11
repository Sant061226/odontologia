<?php
require_once '../fpdf/fpdf.php';

class PDFCita extends FPDF
{
    function Header()
    {
        // Cabecera azul con título
        $this->SetFillColor(5, 151, 253);
        $this->Rect(0, 0, 210, 30, 'F');
        $this->SetFont('Arial', 'B', 20);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 18, utf8_decode('Sistema de Gestión Odontológica'), 0, 1, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, utf8_decode('Registro de Cita'), 0, 1, 'C');
        $this->Ln(2);
    }

    function SectionTitle($label)
    {
        $this->SetFillColor(112, 146, 190);
        $this->SetTextColor(255,255,255);
        $this->SetFont('Arial','B',12);
        $this->Cell(0,8,utf8_decode($label),0,1,'L',true);
        $this->SetTextColor(0,0,0);
        $this->Ln(1);
    }

    function InfoRow($label, $value)
    {
        $this->SetFont('Arial','',11);
        $this->SetFillColor(240,240,240);
        $this->Cell(45,8,utf8_decode($label),0,0,'L',true);
        $this->SetFont('Arial','B',11);
        $this->Cell(0,8,utf8_decode($value),0,1,'L');
    }

    function CitaTable($cita)
    {
        $this->SetFont('Arial','B',11);
        $this->SetFillColor(5,151,253);
        $this->SetTextColor(255,255,255);
        $this->Cell(35,8,'Nro. Cita',1,0,'C',true);
        $this->Cell(30,8,'Fecha',1,0,'C',true);
        $this->Cell(20,8,'Hora',1,0,'C',true);
        $this->Cell(45,8,'Consultorio',1,0,'C',true);
        $this->Cell(30,8,'Estado',1,0,'C',true);
        $this->Cell(0,8,'Observaciones',1,1,'C',true);

        $this->SetFont('Arial','',11);
        $this->SetFillColor(223,223,223);
        $this->SetTextColor(0,0,0);
        $this->Cell(35,8,$cita['CitNumero'],1,0,'C',true);
        $this->Cell(30,8,$cita['CitFecha'],1,0,'C',true);
        $this->Cell(20,8,$cita['CitHora'],1,0,'C',true);
        $this->Cell(45,8,utf8_decode($cita['ConNombre']),1,0,'C',true);
        $this->Cell(30,8,utf8_decode($cita['CitEstado']),1,0,'C',true);
        $this->Cell(0,8,utf8_decode($cita['CitObservaciones']),1,1,'C',true);
        $this->Ln(2);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['CitNumero'])) {
    $citNumero = $_POST['CitNumero'];

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
        $pdf = new PDFCita();
        $pdf->AddPage();
        $pdf->Ln(5);

        // Datos del Paciente
        $pdf->SectionTitle('Datos del Paciente');
        $pdf->InfoRow('Documento:', $cita['PacIdentificacion']);
        $pdf->InfoRow('Nombre:', $cita['PacNombres'].' '.$cita['PacApellidos']);

        // Datos del Médico
        $pdf->SectionTitle('Datos del Médico');
        $pdf->InfoRow('Documento:', $cita['MedIdentificacion']);
        $pdf->InfoRow('Nombre:', $cita['MedNombres'].' '.$cita['MedApellidos']);

        // Tabla de la Cita
        $pdf->SectionTitle('Datos de la Cita');
        $pdf->CitaTable($cita);

        // Pie de página
        $pdf->SetY(-25);
        $pdf->SetFont('Arial','I',9);
        $pdf->SetTextColor(150,150,150);
        $pdf->Cell(0,10,utf8_decode('Generado por el Sistema de Gestión Odontológica - '.date('d/m/Y H:i')),0,0,'C');

        $pdf->Output('D', 'Cita_'.$cita['CitNumero'].'.pdf');
        exit;
    } else {
        echo "No se encontró la cita.";
        exit;
    }
} else {
    echo "Solicitud inválida.";
    exit;
}
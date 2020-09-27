<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

?>

<?php

// Se activa almacenamiento de la sesión
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("location: login.html");
} else {
    require_once "../modelos/Registros.php";
    require_once '../public/fpdf/fpdf.php';

    $id_registro = $_GET["id_registro"];
    $registroPrint = new Registros();
    $rspta = $registroPrint->RegistroIndividual($id_registro);
    $dateRegistro = new DateTime($rspta['fecha_registro']);
    $dateIncidente = new DateTime($rspta['fecha_incidente']);


    if (($_SESSION['superusuario'] == 1) || (($_SESSION['administrador'] == 1)) || (($_SESSION['analista'] == 1)) || (($_SESSION['asistente'] == 1))) {



        class PDF extends FPDF
        {
            // Cabecera de página
            function Header()
            {
                // Logo
                $this->Image('../public/images/logo.png', 25, 15, 33);
                // Arial bold 15
                $this->SetFont('Arial', 'B', 15);
                // Movernos a la derecha
                $this->Ln(10);
                $this->Cell(60);
                // Título
                $this->Cell(80, 10, 'Informe de Registro', 1, 0, 'C');
                // Salto de línea
                $this->Ln(20);
            }
            // Pie de página
            function Footer()
            {
                // Posición: a 1,5 cm del final
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial', 'I', 10);
                // Número de página
                $this->Cell(0, 10, utf8_decode('Página  ') . $this->PageNo() . ' / {nb}', 0, 0, 'C');
            }
        }

        $pdf = new PDF('P', 'mm', 'Letter');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->Ln();
        $pdf->Cell(15);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 10, utf8_decode('Número de Registro:'));
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(5);
        $pdf->Cell(20, 10, utf8_decode($rspta['id_registro']), 0, 0, 'C');
        $pdf->Cell(30);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 10, utf8_decode('Fecha de Registro:'), 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(30, 10, $dateRegistro->format('d-m-Y'), 1, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(110);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 10, utf8_decode('Fecha de Incidente:'), 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(30, 10, $dateIncidente->format('d-m-Y'), 1, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(15);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 10, utf8_decode('Empleado'));
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(70, 10, utf8_decode($rspta['nombres']) . ' ' . utf8_decode($rspta['apellidos']));
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(15);
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40, 10, utf8_decode('Descripción'));
        $pdf->Ln();
        $pdf->Cell(15);
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(165, 7, utf8_decode($rspta['descripcion']));

        $pdf->Output('I', 'registro_incidente_' . $rspta['id_registro'], true);
    } else {
        require 'noacceso.php';
    }

    require 'footer.php';

?>

<?php
}
ob_end_flush();
?>
<?php

// Se activa almacenamiento de la sesión
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("location: login.html");
} else {

    if (($_SESSION['superusuario'] == 1) || (($_SESSION['administrador'] == 1)) || (($_SESSION['analista'] == 1)) || (($_SESSION['asistente'] == 1)) || (($_SESSION['consultas'] == 1))) {
        require_once "../modelos/Empleados.php";
        require_once '../public/fpdf/fpdf.php';

        $empleadoPrint = new Empleados();
        $rspta = $empleadoPrint->ultimoEmpleado();
        //var_dump($rspta);
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
                $this->Cell(80, 10, 'Informe de Empleado', 1, 0, 'C');
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

        // Información Personal
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(45, 10, utf8_decode('Información Personal:'));
        $pdf->Ln();
        $pdf->Line(10, 50, 205, 50);
        // Tipo y número de documentos
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Tipo de Documento:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, utf8_decode($rspta['tipo_identificacion']));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Número de Documento:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, utf8_decode($rspta['numero_identificacion']));
        $pdf->Ln();
        // Apellidos y nombres
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Apellidos:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, utf8_decode($rspta['apellidos']));
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Nombres:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 10, utf8_decode($rspta['nombres']));
        $pdf->Ln();
        // Departamento, Municipio, Dirección, Teléfono fijo, Teléfono celular, Email
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Departamento:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, utf8_decode($rspta['departamento']));
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Municipio:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 10, utf8_decode($rspta['ciudad']));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Dirección:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(150, 10, utf8_decode($rspta['direccion']));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Teléfono fijo:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, utf8_decode($rspta['telefono_fijo']));
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Teléfono celular:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 10, utf8_decode($rspta['telefono_celular']));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Correo Electrónico:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 10, utf8_decode($rspta['email']));
        $pdf->Ln();


        $pdf->Line(10, 130, 205, 130);
        // Información empresarial
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(195, 10, utf8_decode('Información Empresarial:'));
        $pdf->Ln();
        // Número de registro
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(45, 10, utf8_decode('Número de Registro:'));
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(50, 10, utf8_decode($rspta['id']));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(45, 10, utf8_decode('Compañía:'));
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(50, 10, utf8_decode($rspta['compania']));
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Sede:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 10, utf8_decode($rspta['nombre']));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Cargo:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(150, 10, utf8_decode($rspta['cargo']));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(45, 10, utf8_decode('EPS:'));
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(50, 10, utf8_decode($rspta['nombre_eps']));
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('ARL:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(55, 10, utf8_decode($rspta['nombre_arl']));
        $pdf->Ln();

        $pdf->Line(10, 180, 205, 180);
        // Información de Contacto
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(45, 10, utf8_decode('Información de Contacto de Emergencia:'));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(45, 10, utf8_decode('Nombre:'));
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(150, 10, utf8_decode($rspta['nombre_contacto_emergencia']));
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Ln();
        $pdf->Cell(45, 10, utf8_decode('Teléfono:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(150, 10, utf8_decode($rspta['telefono_contacto_emergencia']));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Parentesco:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(150, 10, utf8_decode($rspta['parentesco_contacto_emergencia']));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(45, 10, utf8_decode('Comentarios:'));
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(150, 10, utf8_decode($rspta['comentarios']), 0, 'L');
        $pdf->Ln();

        // Generación del archivo PDF
        $pdf->Output('I', 'Empleado_' . $rspta['numero_identificacion'] . '.pdf', true);
    } else {
        require 'noacceso.php';
    }

    require 'footer.php';

?>

<?php
}
ob_end_flush();
?>
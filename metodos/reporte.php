<?php
require('fpdf186/fpdf.php');

// Crear una instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Título del reporte
$pdf->Cell(0, 10, 'Registro Su Reserva', 0, 1, 'C');

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "citas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
# $idCI = $mysqli->real_escape_string($_POST['CI']);
$IDCI = 30;

// Consulta a la base de datos
$sql = "SELECT id, nombre, fecha, hora, servicio,cant_tramites,ci_solicitante FROM reservas WHERE ID = $IDCI";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Encabezados de la tabla
    $pdf->Cell(10, 10, 'ID', 1);
    $pdf->Cell(30, 10, 'Nombres', 1);
    $pdf->Cell(25, 10, 'Nro. Cedula', 1);
    $pdf->Cell(23, 10, 'Fecha', 1);
    $pdf->Cell(17, 10, 'Hora', 1);
    $pdf->Cell(60, 10, 'Tramite', 1);
    $pdf->Cell(20, 10, 'Cantidad', 1);
    $pdf->Ln();

    // Datos de la tabla
    while($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $row['id'], 1);
        $pdf->Cell(30, 10, $row['nombre'], 1);
        $pdf->Cell(25, 10, $row['ci_solicitante'], 1);
        $pdf->Cell(23, 10, $row['fecha'], 1);
        $pdf->Cell(17, 10, $row['hora'], 1);
        $pdf->Cell(60, 10, $row['servicio'], 1);
        $pdf->Cell(20, 10, '     ' .$row['cant_tramites'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
}

$conn->close();

// Salida del PDF
$pdf->Output();
?>
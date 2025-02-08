<?php
require_once("../../config/connect.php");
include_once('../../TCPDF-main/tcpdf.php');

// Create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Admin');
$pdf->SetTitle('Owner and Property Report');
$pdf->SetHeaderData('', 0, 'Owner and Property Report', 'Generated: ' . date('Y-m-d'));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(15, 27, 15);
$pdf->SetAutoPageBreak(TRUE, 25);
$pdf->SetFont('helvetica', '', 12);
$pdf->AddPage();

$sql = "SELECT o.OwnerID, o.FullName, p.PropertyID, p.Type, p.Total_Room,
            (SELECT COUNT(*) FROM booking WHERE booking.PropertyID = p.PropertyID AND booking.Status = 'Accepted') AS OccupiedRooms
        FROM owner o
        JOIN property p ON o.OwnerID = p.OwnerID";

$result = $conn->query($sql);

$html = '<h2>Owner and Property Report</h2>';
$html .= '<table border="1" cellspacing="3" cellpadding="4">
            <tr>
                <th>Owner Name</th>
                <th>Property ID</th>
                <th>Type</th>
                <th>Total Spaces</th>
                <th>Occupied</th>
                <th>Vacant</th>
            </tr>';

while ($row = $result->fetch_assoc()) {
    $vacant = $row['Total_Room'] - $row['OccupiedRooms'];
    $html .= '<tr>
                <td>' . $row['FullName'] . '</td>
                <td>' . $row['PropertyID'] . '</td>
                <td>' . $row['Type'] . '</td>
                <td>' . $row['Total_Room'] . '</td>
                <td>' . $row['OccupiedRooms'] . '</td>
                <td>' . $vacant . '</td>
              </tr>';
}
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('Owner_Property_Report.pdf', 'I');

$conn->close();
?>
<?php
require_once("../../config/connect.php");
include_once('../../TCPDF-main/tcpdf.php');

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
$pdf->SetFillColor(204, 255, 204); 
$pdf->AddPage();

$sql = "SELECT o.OwnerID, o.FullName, p.PropertyID, p.Type, p.Total_Room,
            (SELECT COUNT(*) FROM booking WHERE booking.PropertyID = p.PropertyID AND booking.Status = 'Accepted') AS OccupiedRooms
        FROM owner o
        JOIN property p ON o.OwnerID = p.OwnerID";

$result = $conn->query($sql);

$html = '<style>
            h2 { color: #2E7D32; text-align: center; }
            table { width: 100%; border-collapse: collapse; font-size: 12px; }
            th { background-color: #66BB6A; color: white; padding: 8px; }
            td { border: 1px solid #ddd; padding: 8px; }
            tr:nth-child(even) { background-color: #E8F5E9; }
            .type { text-transform: uppercase; }
        </style>';
$html .= '<h2>Owner and Property Report</h2>';
$html .= '<table>
            <tr>
                <th>Owner ID</th>
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
                <td>' . $row['OwnerID'] . '</td>
                <td>' . $row['FullName'] . '</td>
                <td>' . $row['PropertyID'] . '</td>
                <td>' . ucfirst($row['Type']) . '</td>
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

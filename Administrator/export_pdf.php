<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Invalid request.');
}

$headers = [];

if (isset($_POST['headers'])) {
    $headers = json_decode($_POST['headers'], true);
}

$rows = [];

if (isset($_POST['rows'])) {
    $rows = json_decode($_POST['rows'], true);
}

if (!is_array($headers) || empty($headers)) {
    exit('No columns were provided for export.');
}

if (!is_array($rows) || empty($rows)) {
    exit('No records were selected.');
}

$exportType = isset($_POST['export_type'])
    ? $_POST['export_type']
    : 'records';

switch ($exportType) {
    case 'subjects':
        $fileName = 'Subjects_' . date('Y-m-d_H-i-s') . '.pdf';
        $title = 'Subject List';
        break;

    default:
        $fileName = 'Export_' . date('Y-m-d_H-i-s') . '.pdf';
        $title = 'Exported Records';
        break;
    }
}

$options = new Options();

$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'DejaVu Sans');

$dompdf = new Dompdf($options);

$html = '
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>

    @page {
        margin: 20px;
    }

    body {
        font-family: DejaVu Sans, Arial, sans-serif;
        font-size: 10px;
        color: #222;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 18px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: #e9ecef;
        border: 1px solid #333;
        padding: 7px;
        text-align: center;
        font-weight: bold;
    }

    td {
        border: 1px solid #555;
        padding: 6px;
        vertical-align: middle;
    }

    tr {
        page-break-inside: avoid;
    }

</style>

</head>

<body>

<h2>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h2>

<table>

<thead>
<tr>
';

foreach ($headers as $header) {

    $html .= '<th>'
        . htmlspecialchars((string)$header, ENT_QUOTES, 'UTF-8')
        . '</th>';
}

$html .= '
</tr>
</thead>

<tbody>
';

foreach ($rows as $row) {

    if (!is_array($row)) {
        continue;
    }

    $html .= '<tr>';

    foreach ($row as $value) {

        $html .= '<td>'
            . htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8')
            . '</td>';
    }

    $html .= '</tr>';
}

$html .= '
</tbody>

</table>

</body>
</html>
';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream(
    $fileName,
    [
        'Attachment' => true
    ]
);

exit;
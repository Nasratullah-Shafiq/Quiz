<?php

/*
|--------------------------------------------------------------------------
| GENERIC EXCEL EXPORT
|--------------------------------------------------------------------------
|
| This file receives:
|
|   headers     -> column names
|   rows        -> selected table rows
|   export_type -> identifies which table is being exported
|
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| ONLY ALLOW POST
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    http_response_code(405);

    exit('Invalid request.');

}


/*
|--------------------------------------------------------------------------
| GET HEADERS
|--------------------------------------------------------------------------
*/

$headers = [];

if (isset($_POST['headers'])) {

    $headers = json_decode(
        $_POST['headers'],
        true
    );

}


/*
|--------------------------------------------------------------------------
| GET ROWS
|--------------------------------------------------------------------------
*/

$rows = [];

if (isset($_POST['rows'])) {

    $rows = json_decode(
        $_POST['rows'],
        true
    );

}


/*
|--------------------------------------------------------------------------
| VALIDATE HEADERS
|--------------------------------------------------------------------------
*/

if (
    !is_array($headers) ||
    empty($headers)
) {

    exit('No columns were provided for export.');

}


/*
|--------------------------------------------------------------------------
| VALIDATE ROWS
|--------------------------------------------------------------------------
*/

if (
    !is_array($rows) ||
    empty($rows)
) {

    exit('No records were selected.');

}


/*
|--------------------------------------------------------------------------
| GET EXPORT TYPE
|--------------------------------------------------------------------------
*/

$exportType =
    isset($_POST['export_type'])
        ? $_POST['export_type']
        : 'records';


/*
|--------------------------------------------------------------------------
| SAFE FILE NAME
|--------------------------------------------------------------------------
*/

switch ($exportType) {

    case 'subjects':

        $fileName =
            'Subjects_' .
            date('Y-m-d_H-i-s') .
            '.xls';

        break;


    default:

        $fileName =
            'Export_' .
            date('Y-m-d_H-i-s') .
            '.xls';

        break;

}


/*
|--------------------------------------------------------------------------
| CLEAN HEADER VALUES
|--------------------------------------------------------------------------
*/

$cleanHeaders = [];

foreach ($headers as $header) {

    $cleanHeaders[] =
        htmlspecialchars(
            (string)$header,
            ENT_QUOTES,
            'UTF-8'
        );

}


/*
|--------------------------------------------------------------------------
| CLEAN ROW VALUES
|--------------------------------------------------------------------------
*/

$cleanRows = [];

foreach ($rows as $row) {

    if (!is_array($row)) {
        continue;
    }


    $cleanRow = [];


    foreach ($row as $value) {

        $cleanRow[] =
            htmlspecialchars(
                (string)$value,
                ENT_QUOTES,
                'UTF-8'
            );

    }


    $cleanRows[] = $cleanRow;

}


/*
|--------------------------------------------------------------------------
| EXCEL DOWNLOAD HEADERS
|--------------------------------------------------------------------------
*/

header(
    'Content-Type: application/vnd.ms-excel; charset=UTF-8'
);

header(
    'Content-Disposition: attachment; filename="' .
    $fileName .
    '"'
);

header('Cache-Control: max-age=0');

header('Cache-Control: max-age=1');

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

header('Pragma: public');


/*
|--------------------------------------------------------------------------
| START EXCEL HTML
|--------------------------------------------------------------------------
*/

echo '<!DOCTYPE html>';

echo '<html>';

echo '<head>';

echo '<meta charset="UTF-8">';


echo '<style>

    table {
        border-collapse: collapse;
        width: 100%;
        font-family: Arial, sans-serif;
    }

    th {
        background-color: #e9ecef;
        color: #000000;
        font-weight: bold;
        border: 1px solid #000000;
        padding: 8px;
        text-align: center;
    }

    td {
        border: 1px solid #000000;
        padding: 8px;
    }

</style>';


echo '</head>';

echo '<body>';

echo '<table>';


/*
|--------------------------------------------------------------------------
| HEADERS
|--------------------------------------------------------------------------
*/

echo '<tr>';


foreach ($cleanHeaders as $header) {

    echo '<th>';

    echo $header;

    echo '</th>';

}


echo '</tr>';


/*
|--------------------------------------------------------------------------
| DATA
|--------------------------------------------------------------------------
*/

foreach ($cleanRows as $row) {

    echo '<tr>';


    foreach ($row as $value) {

        echo '<td>';

        echo $value;

        echo '</td>';

    }


    echo '</tr>';

}


echo '</table>';

echo '</body>';

echo '</html>';


exit;

?>

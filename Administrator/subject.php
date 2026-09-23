
<?php

/*
|--------------------------------------------------------------------------
| PDF EXPORT PROCESSING
|--------------------------------------------------------------------------
| IMPORTANT:
| This block MUST be before Header.php because Header.php may already
| send HTML/output to the browser.
|--------------------------------------------------------------------------
*/

if (
    isset($_POST['export_pdf']) &&
    $_POST['export_pdf'] === '1'
) {

    /*
     * ------------------------------------------------------------
     * LOAD DOMPDF
     * ------------------------------------------------------------
     *
     * subject.php:
     * C:\wamp64\www\Quiz\Administrator\subject.php
     *
     * Composer:
     * C:\wamp64\www\Quiz\vendor\autoload.php
     *
     */

    $autoloadPath =
        dirname(__DIR__) . '/vendor/autoload.php';


    if (!file_exists($autoloadPath)) {

        http_response_code(500);

        exit(
            'Dompdf autoload file was not found. '
            . 'Expected: '
            . $autoloadPath
        );

    }


    require_once $autoloadPath;


    /*
     * ------------------------------------------------------------
     * CHECK DOMPDF
     * ------------------------------------------------------------
     */

    if (
        !class_exists('\Dompdf\Dompdf') ||
        !class_exists('\Dompdf\Options')
    ) {

        http_response_code(500);

        exit(
            'Dompdf is not installed correctly.'
        );

    }


    /*
     * ------------------------------------------------------------
     * GET HEADERS
     * ------------------------------------------------------------
     */

    $headers = [];

    if (isset($_POST['pdf_headers'])) {

        $headers = json_decode(
            $_POST['pdf_headers'],
            true
        );

    }


    /*
     * ------------------------------------------------------------
     * GET SELECTED ROWS
     * ------------------------------------------------------------
     */

    $rows = [];

    if (isset($_POST['pdf_rows'])) {

        $rows = json_decode(
            $_POST['pdf_rows'],
            true
        );

    }


    /*
     * ------------------------------------------------------------
     * VALIDATE HEADERS
     * ------------------------------------------------------------
     */

    if (
        !is_array($headers) ||
        empty($headers)
    ) {

        http_response_code(400);

        exit(
            'No columns were provided for PDF export.'
        );

    }


    /*
     * ------------------------------------------------------------
     * VALIDATE ROWS
     * ------------------------------------------------------------
     */

    if (
        !is_array($rows) ||
        empty($rows)
    ) {

        http_response_code(400);

        exit(
            'No records were selected.'
        );

    }


    /*
     * ------------------------------------------------------------
     * CREATE DOMPDF OPTIONS
     * ------------------------------------------------------------
     */

    $options =
        new \Dompdf\Options();


    $options->set(
        'isHtml5ParserEnabled',
        true
    );


    $options->set(
        'isRemoteEnabled',
        true
    );


    $options->set(
        'defaultFont',
        'DejaVu Sans'
    );


    /*
     * ------------------------------------------------------------
     * CREATE DOMPDF
     * ------------------------------------------------------------
     */

    $dompdf =
        new \Dompdf\Dompdf(
            $options
        );


    /*
     * ------------------------------------------------------------
     * PDF HTML
     * ------------------------------------------------------------
     */

    $html = '
<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <style>

        @page {

            size: A4 landscape;

            margin: 15mm;

        }


        body {

            font-family:
                DejaVu Sans,
                Arial,
                sans-serif;

            font-size: 9px;

            color: #222222;

        }


        .report-title {

            text-align: center;

            font-size: 18px;

            font-weight: bold;

            margin-bottom: 5px;

        }


        .report-date {

            text-align: right;

            font-size: 8px;

            color: #666666;

            margin-bottom: 15px;

        }


        table {

            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;

        }


        th {

            background-color: #e9ecef;

            color: #000000;

            border: 1px solid #333333;

            padding: 6px;

            text-align: center;

            font-weight: bold;

            word-wrap: break-word;

        }


        td {

            border: 1px solid #555555;

            padding: 5px;

            vertical-align: middle;

            word-wrap: break-word;

        }


        tr {

            page-break-inside: avoid;

        }


        tbody tr:nth-child(even) {

            background-color: #f8f9fa;

        }

    </style>

</head>


<body>


    <div class="report-title">
        Subject List
    </div>


    <div class="report-date">
        Generated:
        ' . htmlspecialchars(
            date('Y-m-d H:i:s'),
            ENT_QUOTES,
            'UTF-8'
        ) . '
    </div>


    <table>

        <thead>

            <tr>
';


    /*
     * ------------------------------------------------------------
     * ADD TABLE HEADERS
     * ------------------------------------------------------------
     */

    foreach ($headers as $header) {

        $html .= '
                <th>'
            . htmlspecialchars(
                (string) $header,
                ENT_QUOTES,
                'UTF-8'
            )
            . '</th>';

    }


    $html .= '
            </tr>

        </thead>


        <tbody>
';


    /*
     * ------------------------------------------------------------
     * ADD SELECTED RECORDS
     * ------------------------------------------------------------
     */

    foreach ($rows as $row) {

        if (!is_array($row)) {

            continue;

        }


        $html .= '
            <tr>
';


        foreach ($row as $value) {

            $html .= '
                <td>'
                . htmlspecialchars(
                    (string) $value,
                    ENT_QUOTES,
                    'UTF-8'
                )
                . '</td>';

        }


        $html .= '
            </tr>
';

    }


    $html .= '
        </tbody>

    </table>


</body>

</html>
';


    /*
     * ------------------------------------------------------------
     * LOAD HTML
     * ------------------------------------------------------------
     */

    $dompdf->loadHtml(
        $html
    );


    /*
     * ------------------------------------------------------------
     * A4 LANDSCAPE
     * ------------------------------------------------------------
     */

    $dompdf->setPaper(
        'A4',
        'landscape'
    );


    /*
     * ------------------------------------------------------------
     * RENDER PDF
     * ------------------------------------------------------------
     */

    $dompdf->render();


    /*
     * ------------------------------------------------------------
     * FILE NAME
     * ------------------------------------------------------------
     */

    $fileName =
        'Subjects_' .
        date('Y-m-d_H-i-s') .
        '.pdf';


    /*
     * ------------------------------------------------------------
     * DOWNLOAD PDF
     * ------------------------------------------------------------
     */

    $dompdf->stream(
        $fileName,
        [
            'Attachment' => true
        ]
    );


    exit;
}


/*
|--------------------------------------------------------------------------
| NORMAL PAGE
|--------------------------------------------------------------------------
*/

include('./_Partial Components/Header.php');

?>


<div class="main">


    <!-- =========================================================
         ADD SUBJECT MODAL
         ========================================================= -->

    <div
        class="modal fade"
        id="addSubjectModal"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="fa fa-book"></i>

                        Add Subject

                    </h5>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

                </div>


                <div class="modal-body">

                    <form
                        action=""
                        method="POST"
                    >


                        <!-- Subject -->

                        <div class="mb-3 row">

                            <label
                                class="col-sm-3 col-form-label"
                            >

                                Subject

                            </label>


                            <div class="col-sm-9">

                                <input
                                    type="text"
                                    class="form-control"
                                    name="subject"
                                >

                            </div>

                        </div>


                        <!-- Language -->

                        <div class="mb-3 row">

                            <label
                                class="col-sm-3 col-form-label"
                            >

                                Language

                            </label>


                            <div class="col-sm-9">

                                <select
                                    class="form-select"
                                    name="language"
                                >

                                    <option value="English">
                                        English
                                    </option>

                                    <option value="Dari">
                                        Dari
                                    </option>

                                </select>

                            </div>

                        </div>


                        <!-- Continue adding your fields here -->


                        <div class="text-end">

                            <button
                                type="submit"
                                class="btn btn-primary"
                                name="btn-add-subject"
                            >

                                <i class="fa fa-save"></i>

                                Add Subject

                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         MAIN ROW
         ========================================================= -->

    <div
        class="row"
        style="margin-left:10px;"
    >


        <!-- Navigation -->

        <div>

            <?php

            include(
                './_Partial Components/Navigation.php'
            );

            ?>

        </div>


        <div class="col-12">


            <!-- =================================================
                 PAGE TITLE + SEARCH
                 ================================================= -->

            <div class="row">

                <div
                    class="row align-items-center mb-3"
                >


                    <!-- Page Title -->

                    <div class="col-lg-5">

                        <h2 class="text-dark mb-0">

                            <small class="text-muted">

                                Home

                                <i
                                    class="fa fa-chevron-right px-2"
                                    style="font-size:14px;"
                                ></i>

                                Subject

                            </small>

                        </h2>

                    </div>


                    <!-- Search -->

                    <div class="col-lg-7">

                        <form method="POST">

                            <div class="mb-0">

                                <label
                                    for="searchUser"
                                    class="form-label"
                                >

                                    Search Subjects Here

                                </label>


                                <div
                                    class="input-group input-group-sm"
                                >

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="searchUser"
                                        name="searchUser"
                                        placeholder="Search for Subjects..."
                                    >


                                    <button
                                        class="btn btn-success"
                                        type="submit"
                                    >

                                        <i
                                            class="fa fa-search"
                                        ></i>

                                        Search

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>


            <hr>


            <!-- =================================================
                 BREADCRUMB + ACTIONS
                 ================================================= -->

            <div class="row mb-3">

                <div class="col-12">

                    <div
                        class="d-flex justify-content-between align-items-center flex-wrap gap-2"
                    >


                        <!-- Breadcrumb -->

                        <nav aria-label="breadcrumb">

                            <ol class="breadcrumb mb-0">

                                <li class="breadcrumb-item">

                                    <a href="index">

                                        <i
                                            class="fa fa-dashboard"
                                        ></i>

                                        Dashboard

                                    </a>

                                </li>


                                <li class="breadcrumb-item">

                                    <a
                                        href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addSubjectModal"
                                    >

                                        <i
                                            class="fa fa-plus"
                                        ></i>

                                        Add Subject

                                    </a>

                                </li>

                            </ol>

                        </nav>


                        <!-- =================================================
                             ACTION BUTTONS
                             ================================================= -->

                        <div class="d-flex gap-2">


                            <!-- Action Dropdown -->

                            <div class="dropdown">

                                <button
                                    class="btn btn-secondary btn-sm dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >

                                    <i
                                        class="fa fa-cogs"
                                    ></i>

                                    Action

                                </button>


                                <ul
                                    class="dropdown-menu dropdown-menu-end"
                                >


                                    <!-- =================================
                                         EXPORT EXCEL
                                         ================================= -->

                                    <li>

                                        <a
                                            class="dropdown-item export-excel"
                                            href="#"
                                            data-table="subjectTable"
                                            data-export-url="export_excel.php"
                                        >

                                            <i
                                                class="fa fa-file-excel-o text-success"
                                            ></i>

                                            Export to Excel

                                        </a>

                                    </li>


                                    <!-- =================================
                                         EXPORT PDF
                                         ================================= -->

                                    <li>

                                        <a
                                            class="dropdown-item export-pdf"
                                            href="#"
                                            data-table="subjectTable"
                                        >

                                            <i
                                                class="fa fa-file-pdf-o text-danger"
                                            ></i>

                                            Export to PDF

                                        </a>

                                    </li>


                                    <!-- Print -->

                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="#"
                                        >

                                            <i
                                                class="fa fa-print text-secondary"
                                            ></i>

                                            Print

                                        </a>

                                    </li>


                                    <li>

                                        <hr
                                            class="dropdown-divider"
                                        >

                                    </li>


                                    <!-- Archive -->

                                    <li>

                                        <a
                                            class="dropdown-item"
                                            href="#"
                                        >

                                            <i
                                                class="fa fa-archive text-primary"
                                            ></i>

                                            Archive Selected

                                        </a>

                                    </li>


                                    <!-- Delete -->

                                    <li>

                                        <a
                                            class="dropdown-item text-danger"
                                            href="#"
                                        >

                                            <i
                                                class="fa fa-trash"
                                            ></i>

                                            Delete Selected

                                        </a>

                                    </li>


                                </ul>

                            </div>


                            <!-- Filter -->

                            <button
                                class="btn btn-outline-secondary btn-sm"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#News_Data_Modal"
                            >

                                <i
                                    class="fa fa-filter"
                                ></i>

                                Filter

                            </button>


                            <!-- Group By -->

                            <button
                                class="btn btn-outline-secondary btn-sm"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#News_Data_Modal"
                            >

                                <i
                                    class="fa fa-layer-group"
                                ></i>

                                Group By

                            </button>


                            <!-- Favorite -->

                            <button
                                class="btn btn-outline-warning btn-sm"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#News_Data_Modal"
                            >

                                <i
                                    class="fa fa-star"
                                ></i>

                                Favorite

                            </button>


                        </div>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 SUBJECT TABLE
                 ================================================= -->

            <div
                class="col-md-12"
                id="resultSubject"
            >

                <form method="POST">


                    <?php

                    $Subject =
                        $exm->getSubject();


                    /*
                     * =================================================
                     * NO RESULT OBJECT
                     * =================================================
                     */

                    if (!$Subject) {

                        echo '

                            <div
                                class="alert alert-danger"
                                role="alert"
                                style="font-size:16px;"
                            >

                                Opps!... No Subjects Found

                            </div>

                        ';

                    } else {


                        /*
                         * =================================================
                         * RECORDS EXIST
                         * =================================================
                         */

                        if (
                            $Subject->num_rows > 0
                        ) {


                            /*
                             * Success / Error message
                             */

                            if (isset($error)) {

                                echo "

                                    <span
                                        style='color:red;'
                                        class='pull-right'
                                    >

                                        $error

                                    </span>

                                ";

                            } elseif (isset($msg)) {

                                echo "

                                    <span
                                        style='color:green;'
                                        class='pull-right'
                                    >

                                        $msg

                                    </span>

                                ";

                            }

                    ?>


                    <!-- =================================================
                         TABLE
                         ================================================= -->

                    <table
                        id="subjectTable"
                        class="table table-striped table-hover"
                    >

                        <thead>

                            <tr>


                                <!-- Select All -->

                                <th>

                                    <input
                                        type="checkbox"
                                        id="allselect"
                                    >

                                </th>


                                <th>
                                    ID
                                </th>


                                <th>
                                    Subject
                                </th>


                                <th>
                                    Credit Hours
                                </th>


                                <th>
                                    Time
                                </th>


                                <th>
                                    Teacher
                                </th>


                                <th>
                                    Faculty
                                </th>


                                <th>
                                    Status
                                </th>


                                <!-- Not exported -->

                                <th
                                    data-export-ignore="true"
                                >

                                    Action

                                </th>


                                <!-- Not exported -->

                                <th
                                    data-export-ignore="true"
                                >

                                    Edit

                                </th>


                                <!-- Not exported -->

                                <th
                                    data-export-ignore="true"
                                >

                                    Del

                                </th>


                            </tr>

                        </thead>


                        <tbody>


                        <?php

                        $i = 1;


                        while (
                            $row =
                            $Subject->fetch_array()
                        ) {

                        ?>


                            <tr>


                                <!-- ======================================
                                     SELECT CHECKBOX
                                     ====================================== -->

                                <td>

                                    <input
                                        type="checkbox"
                                        class="record-checkbox row-checkbox"
                                        value="<?php
                                            echo htmlspecialchars(
                                                $row['Subject_ID'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            );
                                        ?>"
                                    >

                                </td>


                                <!-- ======================================
                                     ID
                                     ====================================== -->

                                <td>

                                    <?php

                                    if (
                                        $row['Status'] == 0
                                    ) {

                                        echo '

                                            <div
                                                style="color:#D05454;"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="This Subject is Locked"
                                            >

                                                <i
                                                    class="fa fa-lock"
                                                ></i>

                                                '
                                                . $i .
                                                '

                                            </div>

                                        ';

                                    } else {

                                        echo $i;

                                    }

                                    ?>

                                </td>


                                <!-- ======================================
                                     SUBJECT
                                     ====================================== -->

                                <td class="subject">

                                    <a
                                        href="View-Questions.php?sb=<?php
                                            echo urlencode(
                                                $row['Subject']
                                            );
                                        ?>"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="View all Questions for this subject?"
                                        style="color:black;"
                                    >


                                        <?php

                                        if (
                                            $row['Status'] == 0
                                        ) {

                                            echo '

                                                <div
                                                    style="color:#D05454;"
                                                >

                                                    '
                                                    .
                                                    htmlspecialchars(
                                                        $row['Subject'],
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    )
                                                    .

                                                '

                                                </div>

                                            ';

                                        } else {

                                            echo htmlspecialchars(
                                                $row['Subject'],
                                                ENT_QUOTES,
                                                'UTF-8'
                                            );

                                        }

                                        ?>

                                    </a>

                                </td>


                                <!-- ======================================
                                     CREDIT HOURS
                                     ====================================== -->

                                <td>

                                    <?php

                                    if (
                                        $row['Status'] == 0
                                    ) {

                                        echo '

                                            <div
                                                style="color:#D05454;"
                                            >

                                                '
                                                .
                                                htmlspecialchars(
                                                    $row['Credit_Hours'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                )
                                                .

                                            '

                                            </div>

                                        ';

                                    } else {

                                        echo htmlspecialchars(
                                            $row['Credit_Hours'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );

                                    }

                                    ?>

                                </td>


                                <!-- ======================================
                                     TIME
                                     ====================================== -->

                                <td>

                                    <?php

                                    if (
                                        $row['Status'] == 0
                                    ) {

                                        echo '

                                            <div
                                                style="color:#D05454;"
                                            >

                                                '
                                                .
                                                htmlspecialchars(
                                                    $row['Time'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                )
                                                .

                                                ' Min

                                            </div>

                                        ';

                                    } else {

                                        echo htmlspecialchars(
                                            $row['Time'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        )
                                        .
                                        ' Min';

                                    }

                                    ?>

                                </td>


                                <!-- ======================================
                                     TEACHER
                                     ====================================== -->

                                <td>

                                    <?php

                                    if (
                                        $row['Status'] == 0
                                    ) {

                                        echo '

                                            <div
                                                style="color:#D05454;"
                                            >

                                                '
                                                .
                                                htmlspecialchars(
                                                    $row['Teacher_Name'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                )
                                                .

                                            '

                                            </div>

                                        ';

                                    } else {

                                        echo htmlspecialchars(
                                            $row['Teacher_Name'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );

                                    }

                                    ?>

                                </td>


                                <!-- ======================================
                                     FACULTY
                                     ====================================== -->

                                <td>

                                    <?php

                                    if (
                                        $row['Status'] == 0
                                    ) {

                                        echo '

                                            <div
                                                style="color:#D05454;"
                                            >

                                                '
                                                .
                                                htmlspecialchars(
                                                    $row['Faculty'],
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                )
                                                .

                                            '

                                            </div>

                                        ';

                                    } else {

                                        echo htmlspecialchars(
                                            $row['Faculty'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );

                                    }

                                    ?>

                                </td>


                                <!-- ======================================
                                     STATUS
                                     ====================================== -->

                                <td>

                                    <?php

                                    if (
                                        $row['Status'] == 0
                                    ) {

                                        echo '

                                            <span
                                                style="color:#D05454;"
                                            >

                                                Lock

                                            </span>

                                        ';

                                    } else {

                                        echo '

                                            <span
                                                style="color:#32C5D2;"
                                            >

                                                Unlock

                                            </span>

                                        ';

                                    }

                                    ?>

                                </td>


                                <!-- ======================================
                                     ACTION
                                     ====================================== -->

                                <td
                                    data-export-ignore="true"
                                >

                                    <?php

                                    if (
                                        $row['Status'] == 0
                                    ) {

                                    ?>

                                        <a
                                            onclick="return confirm('Are you sure you want to Allow Subject?')"
                                            href="Enable/EnableSubject.php?enbl=<?php
                                                echo urlencode(
                                                    $row['Subject_ID']
                                                );
                                            ?>"
                                            style="color:#32C5D2;"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Subject is Locked. Do you want to Unlock?"
                                        >

                                            <i
                                                class="fa fa-check"
                                            ></i>

                                            Unlock

                                        </a>

                                    <?php

                                    } else {

                                    ?>

                                        <a
                                            onclick="return confirm('Are you sure you want to Deny Subject?')"
                                            href="Enable/DisableSubject.php?dsbl=<?php
                                                echo urlencode(
                                                    $row['Subject_ID']
                                                );
                                            ?>"
                                            style="color:#D05454;"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Subject is Unlocked. Do you want to Lock it?"
                                        >

                                            <i
                                                class="fa fa-lock"
                                            ></i>

                                            Lock

                                        </a>

                                    <?php

                                    }

                                    ?>

                                </td>


                                <!-- ======================================
                                     EDIT
                                     ====================================== -->

                                <td
                                    data-export-ignore="true"
                                >

                                    <a
                                        href="Edit-Subject.php?edit=<?php
                                            echo urlencode(
                                                $row['Subject_ID']
                                            );
                                        ?>"
                                        style="color:#32C5D2;"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Edit Subject"
                                    >

                                        <i
                                            class="fa fa-pencil"
                                        ></i>

                                    </a>

                                </td>


                                <!-- ======================================
                                     DELETE
                                     ====================================== -->

                                <td
                                    data-export-ignore="true"
                                >

                                    <a
                                        onclick="return confirm('Are you sure you want to delete?')"
                                        href="Delete/DeleteSubject.php?del=<?php
                                            echo urlencode(
                                                $row['Subject_ID']
                                            );
                                        ?>"
                                        style="color:#D05454;"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Delete Subject"
                                    >

                                        <i
                                            class="fa fa-trash"
                                        ></i>

                                    </a>

                                </td>


                            </tr>


                        <?php

                            $i++;

                        }

                        ?>


                        </tbody>

                    </table>


                    <?php


                        /*
                         * =================================================
                         * NO RECORDS
                         * =================================================
                         */

                        } else {

                            echo "<br><br>";


                            echo '

                                <div
                                    class="alert alert-danger"
                                    role="alert"
                                    style="font-size:16px;"
                                >

                                    Opps!... No Subjects Available!

                                </div>

                            ';


                            echo "<br>";

                        }

                    }

                    ?>

                </form>

            </div>


        </div>

    </div>

</div>


<!-- =============================================================
     TABLE SELECTION + EXCEL + PDF EXPORT
     ============================================================= -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /*
         * ========================================================
         * SELECT / DESELECT ALL
         * ========================================================
         */

        const allSelect =
            document.getElementById(
                'allselect'
            );


        if (allSelect) {

            allSelect.addEventListener(
                'change',
                function () {


                    const table =
                        document.getElementById(
                            'subjectTable'
                        );


                    if (!table) {

                        return;

                    }


                    table
                        .querySelectorAll(
                            '.record-checkbox'
                        )
                        .forEach(
                            function (checkbox) {

                                checkbox.checked =
                                    allSelect.checked;

                            }
                        );


                    allSelect.indeterminate =
                        false;

                }
            );

        }


        /*
         * ========================================================
         * INDIVIDUAL CHECKBOXES
         * ========================================================
         */

        document
            .querySelectorAll(
                '#subjectTable .record-checkbox'
            )
            .forEach(
                function (checkbox) {


                    checkbox.addEventListener(
                        'change',
                        function () {


                            const table =
                                document.getElementById(
                                    'subjectTable'
                                );


                            if (
                                !table ||
                                !allSelect
                            ) {

                                return;

                            }


                            const checkboxes =
                                table.querySelectorAll(
                                    '.record-checkbox'
                                );


                            const checked =
                                table.querySelectorAll(
                                    '.record-checkbox:checked'
                                );


                            /*
                             * Nothing selected
                             */

                            if (
                                checked.length === 0
                            ) {

                                allSelect.checked =
                                    false;

                                allSelect.indeterminate =
                                    false;

                            }


                            /*
                             * Everything selected
                             */

                            else if (
                                checked.length ===
                                checkboxes.length
                            ) {

                                allSelect.checked =
                                    true;

                                allSelect.indeterminate =
                                    false;

                            }


                            /*
                             * Some selected
                             */

                            else {

                                allSelect.checked =
                                    false;

                                allSelect.indeterminate =
                                    true;

                            }

                        }
                    );

                }
            );


        /*
         * ========================================================
         * GET SELECTED TABLE DATA
         * ========================================================
         */

        function getSelectedTableData(
            table
        ) {


            const rowsToExport = [];


            /*
             * ----------------------------------------------------
             * SELECTED ROWS
             * ----------------------------------------------------
             */

            table
                .querySelectorAll(
                    'tbody tr'
                )
                .forEach(
                    function (row) {


                        const checkbox =
                            row.querySelector(
                                '.record-checkbox'
                            );


                        /*
                         * Skip unselected row
                         */

                        if (
                            !checkbox ||
                            !checkbox.checked
                        ) {

                            return;

                        }


                        const cells = [];


                        /*
                         * ------------------------------------------------
                         * TABLE CELLS
                         * ------------------------------------------------
                         */

                        row
                            .querySelectorAll(
                                'td'
                            )
                            .forEach(
                                function (cell) {


                                    /*
                                     * Ignore checkbox column
                                     */

                                    if (
                                        cell.querySelector(
                                            'input[type="checkbox"]'
                                        )
                                    ) {

                                        return;

                                    }


                                    /*
                                     * Ignore Action/Edit/Delete
                                     */

                                    if (
                                        cell.dataset
                                            .exportIgnore ===
                                        'true'
                                    ) {

                                        return;

                                    }


                                    /*
                                     * Get visible text
                                     */

                                    let value =
                                        cell.innerText.trim();


                                    /*
                                     * Clean whitespace
                                     */

                                    value =
                                        value.replace(
                                            /\s+/g,
                                            ' '
                                        );


                                    cells.push(
                                        value
                                    );

                                }
                            );


                        rowsToExport.push(
                            cells
                        );

                    }
                );


            /*
             * ----------------------------------------------------
             * HEADERS
             * ----------------------------------------------------
             */

            const headers = [];


            table
                .querySelectorAll(
                    'thead th'
                )
                .forEach(
                    function (header) {


                        /*
                         * Ignore Action/Edit/Delete
                         */

                        if (
                            header.dataset
                                .exportIgnore ===
                            'true'
                        ) {

                            return;

                        }


                        /*
                         * Ignore select checkbox
                         */

                        if (
                            header.querySelector(
                                'input[type="checkbox"]'
                            )
                        ) {

                            return;

                        }


                        headers.push(
                            header.innerText.trim()
                        );

                    }
                );


            return {

                headers:
                    headers,

                rows:
                    rowsToExport

            };

        }


        /*
         * ========================================================
         * EXPORT TO EXCEL
         * ========================================================
         */

        document
            .querySelectorAll(
                '.export-excel'
            )
            .forEach(
                function (button) {


                    button.addEventListener(
                        'click',
                        function (event) {


                            event.preventDefault();


                            const tableId =
                                button.dataset.table;


                            const table =
                                document.getElementById(
                                    tableId
                                );


                            if (!table) {

                                alert(
                                    'Table not found.'
                                );

                                return;

                            }


                            const exportData =
                                getSelectedTableData(
                                    table
                                );


                            /*
                             * Nothing selected
                             */

                            if (
                                exportData.rows.length === 0
                            ) {

                                alert(
                                    'Please select at least one record to export.'
                                );

                                return;

                            }


                            /*
                             * Create form
                             */

                            const form =
                                document.createElement(
                                    'form'
                                );


                            form.method =
                                'POST';


                            form.action =
                                button.dataset.exportUrl ||
                                'export_excel.php';


                            form.style.display =
                                'none';


                            /*
                             * Headers
                             */

                            const headersInput =
                                document.createElement(
                                    'input'
                                );


                            headersInput.type =
                                'hidden';

                            headersInput.name =
                                'headers';

                            headersInput.value =
                                JSON.stringify(
                                    exportData.headers
                                );


                            form.appendChild(
                                headersInput
                            );


                            /*
                             * Rows
                             */

                            const rowsInput =
                                document.createElement(
                                    'input'
                                );


                            rowsInput.type =
                                'hidden';

                            rowsInput.name =
                                'rows';

                            rowsInput.value =
                                JSON.stringify(
                                    exportData.rows
                                );


                            form.appendChild(
                                rowsInput
                            );


                            /*
                             * Export type
                             */

                            const typeInput =
                                document.createElement(
                                    'input'
                                );


                            typeInput.type =
                                'hidden';

                            typeInput.name =
                                'export_type';

                            typeInput.value =
                                'subjects';


                            form.appendChild(
                                typeInput
                            );


                            /*
                             * Submit
                             */

                            document.body.appendChild(
                                form
                            );


                            form.submit();


                            form.remove();

                        }
                    );

                }
            );


        /*
         * ========================================================
         * EXPORT TO PDF
         * ========================================================
         */

        document
            .querySelectorAll(
                '.export-pdf'
            )
            .forEach(
                function (button) {


                    button.addEventListener(
                        'click',
                        function (event) {


                            event.preventDefault();


                            const tableId =
                                button.dataset.table;


                            const table =
                                document.getElementById(
                                    tableId
                                );


                            if (!table) {

                                alert(
                                    'Table not found.'
                                );

                                return;

                            }


                            /*
                             * Get selected data
                             */

                            const exportData =
                                getSelectedTableData(
                                    table
                                );


                            /*
                             * Nothing selected
                             */

                            if (
                                exportData.rows.length === 0
                            ) {

                                alert(
                                    'Please select at least one record to export.'
                                );

                                return;

                            }


                            /*
                             * Create PDF POST form
                             */

                            const form =
                                document.createElement(
                                    'form'
                                );


                            form.method =
                                'POST';


                            /*
                             * Same PHP file
                             */

                            form.action =
                                window.location.href;


                            /*
                             * Open PDF in new tab
                             */

                            form.target =
                                '_blank';


                            form.style.display =
                                'none';


                            /*
                             * PDF flag
                             */

                            const pdfInput =
                                document.createElement(
                                    'input'
                                );


                            pdfInput.type =
                                'hidden';

                            pdfInput.name =
                                'export_pdf';

                            pdfInput.value =
                                '1';


                            form.appendChild(
                                pdfInput
                            );


                            /*
                             * PDF headers
                             */

                            const headersInput =
                                document.createElement(
                                    'input'
                                );


                            headersInput.type =
                                'hidden';

                            headersInput.name =
                                'pdf_headers';

                            headersInput.value =
                                JSON.stringify(
                                    exportData.headers
                                );


                            form.appendChild(
                                headersInput
                            );


                            /*
                             * PDF rows
                             */

                            const rowsInput =
                                document.createElement(
                                    'input'
                                );


                            rowsInput.type =
                                'hidden';

                            rowsInput.name =
                                'pdf_rows';

                            rowsInput.value =
                                JSON.stringify(
                                    exportData.rows
                                );


                            form.appendChild(
                                rowsInput
                            );


                            /*
                             * Export type
                             */

                            const typeInput =
                                document.createElement(
                                    'input'
                                );


                            typeInput.type =
                                'hidden';

                            typeInput.name =
                                'pdf_export_type';

                            typeInput.value =
                                'subjects';


                            form.appendChild(
                                typeInput
                            );


                            /*
                             * Submit
                             */

                            document.body.appendChild(
                                form
                            );


                            form.submit();


                            form.remove();

                        }
                    );

                }
            );


    }
);

</script>


<!-- =============================================================
     BOOTSTRAP TOOLTIP
     ============================================================= -->

<script>

$(function () {

    $('[data-toggle="tooltip"]').tooltip();

});

</script>


<?php

include(
    './_Partial Components/Footer.php'
);

?>


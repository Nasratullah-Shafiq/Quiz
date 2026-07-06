<?php
session_start();

include('./_Partial Components/User.php');
include('./_Partial Components/Method.php');
include('./_Partial Components/Database.php');
include('./_Partial Components/Format.php');

if (!isset($_SESSION['Username'])) {
    header('Location: sign_in.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$ans = new User();
$exm = new Method();
$db = new Database();
$fm = new Format();

$Subject_ID = (int)$_GET['id'];

$answer = $ans->answer($_POST);

$subjectByTime = $exm->getSubject($Subject_ID);
$rowQuiz = $subjectByTime->fetch_assoc();

$Username = $_SESSION['Username'];

$UsersByUsername = $exm->getUsersByUsername($Username);
$user = $UsersByUsername->fetch_assoc();

$profile_img = $user['Image'];

$total_question =
    $answer['right'] +
    $answer['wrong'] +
    $answer['no_answer'];

$attempt_question =
    $total_question -
    $answer['no_answer'];

$percent =
    $total_question > 0
        ? round(($answer['right'] / $total_question) * 100)
        : 0;

if ($percent < 75) {
    $grade = 'F';
    $message = 'Sorry! You failed.';
    $badgeClass = 'danger';
} elseif ($percent < 85) {
    $grade = 'C';
    $message = 'Good! You got Grade C';
    $badgeClass = 'warning';
} elseif ($percent < 90) {
    $grade = 'B';
    $message = 'Very Good! You got Grade B';
    $badgeClass = 'info';
} else {
    $grade = 'A';
    $message = 'Excellent! You got Grade A';
    $badgeClass = 'success';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Exam Result</title>

<link rel="stylesheet" href="./css/bootstrap.min.css">

<style>

body{
    background:#f4f7fc;
    font-family:'Segoe UI',sans-serif;
}

.result-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,.12);
}

.result-header{
    background:linear-gradient(
        135deg,
        #0d6efd,
        #6610f2
    );
    color:#fff;
    padding:25px;
}

.profile-image{
    width:180px;
    height:180px;
    border-radius:50%;
    object-fit:cover;
    border:6px solid #fff;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.stat-card{
    border:none;
    border-radius:15px;
    transition:.3s;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.stat-card:hover{
    transform:translateY(-5px);
}

.score-circle{
    width:220px;
    height:220px;
    border-radius:50%;
    margin:auto;

    display:flex;
    justify-content:center;
    align-items:center;

    background:conic-gradient(
        #198754 0deg,
        #198754 <?= $percent * 3.6 ?>deg,
        #e9ecef <?= $percent * 3.6 ?>deg,
        #e9ecef 360deg
    );
}

.score-inner{
    width:170px;
    height:170px;
    background:#fff;
    border-radius:50%;

    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
}

.score-value{
    font-size:45px;
    font-weight:bold;
}

.custom-btn{
    border-radius:50px;
    padding:12px 30px;
    font-weight:600;
}

@media print{
    .no-print{
        display:none;
    }
}

</style>

</head>

<body>

<div class="container py-5">

    <div class="card result-card">

        <div class="result-header text-center">

            <h2 class="mb-0">
                Online Examination Result
            </h2>

        </div>

        <div class="card-body p-5">

            <div class="row">

                <div class="col-md-4 text-center">

                    <img
                        src="./img/_ProfilePicture/<?= htmlspecialchars($profile_img) ?>"
                        class="profile-image"
                        alt="Profile">

                    <h3 class="mt-4">
                        <?= htmlspecialchars($user['Full_Name']) ?>
                    </h3>

                    <p class="text-muted">
                        <?= htmlspecialchars($user['Username']) ?>
                    </p>

                </div>

                <div class="col-md-8">

                    <div class="row">

                        <div class="col-md-6">

                            <p>
                                <strong>Teacher:</strong>
                                <?= htmlspecialchars($rowQuiz['Teacher_Name']) ?>
                            </p>

                            <p>
                                <strong>Subject:</strong>
                                <?= htmlspecialchars($rowQuiz['Subject']) ?>
                            </p>

                            <p>
                                <strong>Credit Hours:</strong>
                                <?= htmlspecialchars($rowQuiz['Credit_Hours']) ?>
                            </p>

                        </div>

                        <div class="col-md-6">

                            <p>
                                <strong>Total Questions:</strong>
                                <?= $total_question ?>
                            </p>

                            <p>
                                <strong>Attempted:</strong>
                                <?= $attempt_question ?>
                            </p>

                            <p>
                                <strong>Not Answered:</strong>
                                <?= $answer['no_answer'] ?>
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <hr class="my-5">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <div class="card stat-card text-center">

                        <div class="card-body">

                            <h1 class="text-success">
                                <?= $answer['right'] ?>
                            </h1>

                            <h5>Correct Answers</h5>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 mb-3">

                    <div class="card stat-card text-center">

                        <div class="card-body">

                            <h1 class="text-danger">
                                <?= $answer['wrong'] ?>
                            </h1>

                            <h5>Wrong Answers</h5>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 mb-3">

                    <div class="card stat-card text-center">

                        <div class="card-body">

                            <h1 class="text-warning">
                                <?= $answer['no_answer'] ?>
                            </h1>

                            <h5>No Answer</h5>

                        </div>

                    </div>

                </div>

            </div>

            <hr class="my-5">

            <div class="score-circle">

                <div class="score-inner">

                    <div class="score-value">
                        <?= $percent ?>%
                    </div>

                    <small>
                        Final Score
                    </small>

                </div>

            </div>

            <div class="text-center mt-4">

                <span class="badge bg-<?= $badgeClass ?> fs-4">
                    Grade <?= $grade ?>
                </span>

                <h3 class="mt-3">
                    <?= $message ?>
                </h3>

            </div>

            <div class="progress mt-4" style="height:25px">

                <div
                    class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                    style="width:<?= $percent ?>%">

                    <?= $percent ?>%

                </div>

            </div>

            <div class="text-center mt-5 no-print">

                <button
                    onclick="window.print()"
                    class="btn btn-primary custom-btn">

                    Print Result

                </button>

                <a
                    href="Exam.php?id=<?= $Subject_ID ?>"
                    class="btn btn-success custom-btn">

                    Start Again

                </a>
                <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <button type="button" class="btn " id = "btn-add-result" > Save Result </button>
                  <span id="span-valid" class="span-validation"></span> 
                </div>
              </div>

            </div>

        </div>

    </div>

</div>

<script src="./js/bootstrap.bundle.min.js"></script>

</body>
</html>
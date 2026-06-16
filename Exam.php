<?php
include('./_Partial Components/Header.php');

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$Subject_ID = $_GET['id'];

/* =========================
   SESSION INIT
========================= */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* =========================
   USER STATUS CHECK
========================= */
if (isset($_SESSION['Username'])) {

    $Username = $_SESSION['Username'];
    $UsersByUsername = $exm->getUsersByUsername($Username);
    $user = $UsersByUsername->fetch_assoc();

    if ($user['Status'] == '0') {
        header('Location: index.php');
        exit;
    }
}

/* =========================
   SUBJECT DATA
========================= */
$subjectData = $exm->getSubject($Subject_ID);
$row = $subjectData->fetch_assoc();

/* =========================
   TIMER (FIXED SESSION START)
========================= */
$examTimeInMinutes = (int)$row['Time'];

/* START TIME ONLY ONCE */
if (!isset($_SESSION['exam_start_time'])) {
    $_SESSION['exam_start_time'] = time();
}

$startTime = $_SESSION['exam_start_time'];
$endTime = $startTime + ($examTimeInMinutes * 60);

/* =========================
   QUESTION SYSTEM
========================= */
$q = isset($_GET['q']) ? (int)$_GET['q'] : 1;

$count = mysqli_query(
    $con,
    "SELECT * FROM Question
     WHERE Subject_ID='$Subject_ID'
     AND Language='English'"
);

$totalQuestions = mysqli_num_rows($count);

$offset = $q - 1;

$get = mysqli_query(
    $con,
    "SELECT *
     FROM Question
     WHERE Subject_ID='$Subject_ID'
     AND Language='English'
     ORDER BY Question_ID ASC
     LIMIT $offset,1"
);

$question = mysqli_fetch_assoc($get);

if (!$question) {
    header("Location:index.php");
    exit;
}

/* =========================
   SAVE + NAVIGATION
========================= */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['answer'])) {
        $_SESSION['quiz_answers'][$question['Question_ID']] = $_POST['answer'];
    }

    if (isset($_POST['next'])) {
        header("Location: exam.php?id=$Subject_ID&q=" . ($q + 1));
        exit;
    }

    if (isset($_POST['previous'])) {
        header("Location: exam.php?id=$Subject_ID&q=" . ($q - 1));
        exit;
    }

    if (isset($_POST['finish'])) {
        unset($_SESSION['exam_start_time']); // cleanup
        header("Location: QuizAnswer.php?id=$Subject_ID");
        exit;
    }
}

/* =========================
   PROGRESS
========================= */
$progress = ($q / $totalQuestions) * 100;

/* =========================
   SELECTED ANSWER
========================= */
$selected =
$_SESSION['quiz_answers'][$question['Question_ID']] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Exam</title>

    <link rel="stylesheet" href="assets/CSS/bootstrap.min.css">

    <!-- =========================
         TIMER SCRIPT (NO RESET)
    ========================== -->
    <script>
        var endTime = <?php echo $endTime; ?>;

        function updateTimer() {

            var now = Math.floor(Date.now() / 1000);
            var remaining = endTime - now;

            if (remaining <= 0) {
                document.getElementById("Time").innerHTML = "00:00";
                document.getElementById("QuizAnswer").submit();
                return;
            }

            var minutes = Math.floor(remaining / 60);
            var seconds = remaining % 60;

            if (minutes < 10) minutes = "0" + minutes;
            if (seconds < 10) seconds = "0" + seconds;

            document.getElementById("Time").innerHTML =
                minutes + ":" + seconds;

            if (remaining < 60) {
                document.getElementById("Time").style.color = "red";
            }
        }

        setInterval(updateTimer, 1000);
    </script>

</head>

<body onload="updateTimer()">

<div class="container">

    <!-- SUBJECT -->
    <h2><?php echo $row['Subject']; ?> Quiz</h2>

    <!-- TIMER -->
    <h4>
        Time Left:
        <span id="Time"></span>
    </h4>

    <!-- PROGRESS -->
    <div class="progress">
        <div class="progress-bar"
             style="width:<?php echo $progress; ?>%">
            <?php echo round($progress); ?>%
        </div>
    </div>

    <h4>
        Question <?php echo $q; ?> of <?php echo $totalQuestions; ?>
    </h4>

    <!-- FORM -->
    <form method="POST" id="QuizAnswer">

        <table class="table">

            <tr>
                <th><?php echo $question['Question']; ?></th>
            </tr>

            <tr>
                <td>
                    <input type="radio" name="answer" value="0"
                        <?php echo ($selected=='0')?'checked':''; ?>>
                    <?php echo $question['Answer0']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="radio" name="answer" value="1"
                        <?php echo ($selected=='1')?'checked':''; ?>>
                    <?php echo $question['Answer1']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="radio" name="answer" value="2"
                        <?php echo ($selected=='2')?'checked':''; ?>>
                    <?php echo $question['Answer2']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="radio" name="answer" value="3"
                        <?php echo ($selected=='3')?'checked':''; ?>>
                    <?php echo $question['Answer3']; ?>
                </td>
            </tr>

        </table>

        <!-- NAVIGATION -->
        <?php if ($q > 1) { ?>
            <button type="submit" name="previous"
                    class="btn btn-primary">
                Previous
            </button>
        <?php } ?>

        <?php if ($q < $totalQuestions) { ?>
            <button type="submit" name="next"
                    class="btn btn-success">
                Next
            </button>
        <?php } ?>

        <?php if ($q == $totalQuestions) { ?>
            <button type="submit" name="finish"
                    class="btn btn-danger">
                Finish Exam
            </button>
        <?php } ?>

    </form>

</div>

</body>
</html>
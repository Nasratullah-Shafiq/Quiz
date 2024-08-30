<?php

include('./_Partial Components/Header.php');

if (isset($_GET['id'])) {
    $Subject_ID = $_GET['id'];
    $question = $exm->getQuestion($Subject_ID);
} else {
    header('Location: index.php');
    exit();
}

if (isset($_SESSION['Username'])) {
    $Username = $_SESSION['Username'];
    $UsersByUsername = $exm->getUsersByUsername($Username);
    $rowUser = $UsersByUsername->fetch_assoc();

    if ($rowUser['Status'] == '0') {
        header('Location: index.php');
        exit();
    }
}

?>

<div class="jumbotron" id="jbt" style="background-image: url('./assets/img/IBPS-Banne.jpg'); background-size: cover;">
    <div class="container">
        <div id="details" class="animated fadeInUp">
            <h1> ONLINE <span> QUIZ </span> SYSTEM </h1>
            <p class="paragraph">Test Your Intellect</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">

        <!-- Navigation -->
        <div class="col-md-3" id="sam">
            <?php include('./_Partial Components/Navigation.php'); ?>
        </div>

        <?php
        $subjectByTime = $exm->getSubject($Subject_ID);
        $subject = $subjectByTime->fetch_assoc();
        ?>

        <script type="text/javascript">
            var timeLeft = <?php echo $subject['Time'] * 60; ?>;
        </script>

        <!-- Quiz Area -->
        <div class="col-md-9">

            <p class="page-heading">
                <?php echo $subject['Subject']; ?> Quiz
            </p>

                <div class="quiz-header">

                    <div class="msg" id="msg"></div>

                    <div class="timer" id="timer">
                        Time Left: <span id="Time">00:00</span>
                    </div>

                </div>
                
             

            <form method="POST" action="answer.php?id=<?php echo $subject['Subject_ID']; ?>" id="QuizAnswer">

                <div id="attention">
                    <p class="paragraph">
                        Pay attention: once you select an answer, it will be submitted when you move forward.
                    </p>
                </div>

                <?php
                $i = 0;

                $count = mysqli_query($con, "SELECT * FROM Question WHERE Subject_ID='$Subject_ID' AND Language='English'");
                $c = mysqli_num_rows($count);

                $rand = rand(0, $c);
                $get = mysqli_query($con, "SELECT * FROM Question WHERE Subject_ID='$Subject_ID' AND Question_ID>'$rand' LIMIT 12");

                if (mysqli_num_rows($get) > 0) {

                    while ($row = mysqli_fetch_array($get)) {
                ?>

                <!-- QUESTION BOX -->
                <div class="question-box" style="<?php echo ($i == 0) ? '' : 'display:none;'; ?>">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Q<?php echo $i + 1; ?>:
                                    <?php echo $row['Question']; ?>
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (isset($row['Answer0'])) { ?>
                            <tr>
                                <td>
                                    <input type="radio"
                                           name="question[<?php echo $row['Question_ID']; ?>]"
                                           value="0">
                                    <?php echo $row['Answer0']; ?>
                                </td>
                            </tr>
                            <?php } ?>

                            <?php if (isset($row['Answer1'])) { ?>
                            <tr>
                                <td>
                                    <input type="radio"
                                           name="question[<?php echo $row['Question_ID']; ?>]"
                                           value="1">
                                    <?php echo $row['Answer1']; ?>
                                </td>
                            </tr>
                            <?php } ?>

                            <?php if (isset($row['Answer2'])) { ?>
                            <tr>
                                <td>
                                    <input type="radio"
                                           name="question[<?php echo $row['Question_ID']; ?>]"
                                           value="2">
                                    <?php echo $row['Answer2']; ?>
                                </td>
                            </tr>
                            <?php } ?>

                            <?php if (isset($row['Answer3'])) { ?>
                            <tr>
                                <td>
                                    <input type="radio"
                                           name="question[<?php echo $row['Question_ID']; ?>]"
                                           value="3">
                                    <?php echo $row['Answer3']; ?>
                                </td>
                            </tr>
                            <?php } ?>

                            <!-- default no attempt -->
                            <tr style="display:none;">
                                <td>
                                    <input type="radio"
                                           checked
                                           value="No_Attempt"
                                           name="question[<?php echo $row['Question_ID']; ?>]">
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

                <?php
                        $i++;
                    }

                } else {
                    echo '<div class="alert alert-danger">Oops! No Questions available.</div>';
                }
                ?>

                <!-- NAVIGATION BUTTONS -->
                <div style="text-align:center; margin-top:20px;">

                    <button type="button" id="prevBtn" class="btn btn-primary" style="display:none;">
                        Previous
                    </button>

                    <button type="button" id="nextBtn" class="btn btn-success">
                        Next
                    </button>

                </div>

                <br>

                <!-- SUBMIT -->
                <input type="submit"
                       id="submitBtn"
                       value="Submit Quiz"
                       class="button-start-the-quiz"
                       style="display:none;">

            </form>

        </div>
    </div>
</div>

<div id="topBtn"><i class="fa fa-arrow-up"></i></div>

<script>

let current = 0;

const questions = document.querySelectorAll(".question-box");

const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");
const submitBtn = document.getElementById("submitBtn");

function showQuestion(index) {

    questions.forEach(q => q.style.display = "none");

    questions[index].style.display = "block";

    // prev button
    prevBtn.style.display = (index === 0) ? "none" : "inline-block";

    // next / submit toggle
    if (index === questions.length - 1) {
        nextBtn.style.display = "none";
        submitBtn.style.display = "inline-block";
    } else {
        nextBtn.style.display = "inline-block";
        submitBtn.style.display = "none";
    }
}

showQuestion(current);

nextBtn.addEventListener("click", function () {
    if (current < questions.length - 1) {
        current++;
        showQuestion(current);
    }
});

prevBtn.addEventListener("click", function () {
    if (current > 0) {
        current--;
        showQuestion(current);
    }
});

</script>

<?php include('./_Partial Components/Footer.php'); ?>
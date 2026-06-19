<?php

include('./_Partial Components/Header.php');
?>


<div class="jumbotron" id="jbt" style="background-image: url('./assets/img/IBPS-Banne.jpg'); background-size: cover;">
    <div class="container">
        <div id="details" class="animated fadeInLeft">

            <h1>
                <?= $lang['about_title']; ?>
                <span><?= $lang['quiz']; ?></span>
            </h1>

            <p class="paragraph">
                <?= $lang['about_subtitle']; ?>
            </p>

        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2><?= $lang['about_heading']; ?></h2>

            <p><?= $lang['about_p1']; ?></p>

            <p><?= $lang['about_p2']; ?></p>

        </div>
    </div>
</div>

<?php
include('./_Partial Components/Footer.php');
?>

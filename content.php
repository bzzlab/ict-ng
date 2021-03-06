<?php
require_once(__DIR__ . '/lib/Navigation.php');
$nav = new Navigation();
require_once(__DIR__ . '/lib/Teacher.php');
require_once(__DIR__ . '/lib/Semester.php');
require_once(__DIR__ . '/lib/Content.php');
$content = new Content();
require_once(__DIR__ . '/lib/Year.php');
require_once(__DIR__ . '/lib/enums/ModeTypeEnum.php');
require_once(__DIR__ . '/lib/System.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include_once("inc/head.inc"); ?>
    <link href="inc/vendor/prism/prism.css" rel="stylesheet" data-noprefix>
</head>
<body>
<!-- Fixed navbar -->
<?php if (!isset($_GET["top"])) { ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <!-- creates li-items see https://getbootstrap.com/docs/4.3/components/navbar/ -->
            <?php $nav->setLinksOfTopNavigation(); ?>
            <?php $nav->writeDropDownSemester(); ?>
            <?php $nav->writeDropDownMore(); ?>
        </ul>
    </div>
</nav>
<?php } elseif (isset($_GET["top"])) {
            if ($_GET["top"] == 1) {
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav" style="float:right;">
<!--        <li class="nav-item"><button type="button" class="nav-link" onclick="history.back(-1)">Zurück</button>-->
<!--        </li>-->
        <li class="nav-item"><a class="nav-link" href="#" onclick="history.back(-1)">Zurück</a></li>
    </ul>
</nav>
<?php }
    elseif($_GET["top"] == 2) {
        //don't show any navigation
    }
} ?>
<div class="container-fluid" role="main">
    <?php

    /**
     * This part is used for direct links called outside
     * of this platform.
     */
    if (isset($_GET["file"])){
        $semester = new Semester();
        $teacher = new Teacher();
        $year = new Year();
        //init variables
        $lp = $teacher->getValue();
        $ye = $year->getValue();
        $sem = $semester->getValue();
        //set hidden data for adjust-links

        //set teacher
        if (isset($_GET["lp"])) {
            $lp = $_GET["lp"];
            if (isset($_GET["mode"]) && ($_GET["mode"]==ModeTypeEnum::Persist) ) {
                $teacher->setSessionValue($_GET["lp"]);
            }
        }

        //set year
        if (isset($_GET["year"])) {
            $ye = $_GET["year"];
            if (isset($_GET["mode"]) && ($_GET["mode"]==ModeTypeEnum::Persist) ) {
                $year->setSessionValue($_GET["year"]);
            }
        }


        //set semester
        if (isset($_GET["sem"])) {
            $sem = $_GET["sem"];
            if (isset($_GET["mode"]) && ($_GET["mode"]==ModeTypeEnum::Persist) ) {
                $semester->setSessionValue($_GET["sem"]);
            }
            $semester->setSessionValue($_GET["sem"]);
        }

        /**
         *  Set hidden values. Call method when all session values are set.
         */
        $nav->setHiddenSessions($lp,$ye,$sem);
        //verbose info
        System::console_log(sprintf("content.php: hidden data set -> lp=%s, ye=%s, sem=%s",$lp,$ye,$sem));

        $file = $nav->getNewPath($_GET["file"], $lp, $ye, $sem);
        if (isset($_GET["inc"]) && ($_GET["inc"]==1) ) {
            $content->showWithIncludes($file);
        } else {
            $content->show($file);
            if (isset($_GET["sol"]) && ($_GET["sol"]==1) ) {
                echo "<script>showSolution(document.querySelectorAll('.solution'));</script>";
            }
        }
    }
    //set hidden value for javascript (i.e. script/ajustlinks.js)
    ?>
</div> <!-- /container -->
<?php include_once(__DIR__ ."/inc/footer.inc"); ?>
<script type="application/javascript" src="inc/script/adjust-links.js"></script>
<script src="inc/vendor/prism/prism.js"></script>
<script src="inc/vendor/prism/prism-line-numbers.js"></script>
</body>
</html>
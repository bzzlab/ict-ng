<?php
require_once(__DIR__ . '/lib/Navigation.php');
$nav = new Navigation();
require_once(__DIR__ . '/lib/Teacher.php');
require_once(__DIR__ . '/lib/Semester.php');
require_once(__DIR__ . '/lib/Content.php');
$content = new Content();
require_once(__DIR__ . '/lib/Year.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include_once("inc/head.inc"); ?>
    <link href="inc/dashboard.css" rel="stylesheet">
</head>
<body>
<!-- Fixed navbar -->
<?php if (!isset($_GET["top"])) { ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
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
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav" style="float:right;">
        <li><button type="button" class="btn btn-link" onclick="history.back(-1)">Zurück</button>
        </li>
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
        $lp = $sem = $ye = "";

        if (isset($_GET["lp"])) {
            $teacher->setSessionValue($_GET["lp"]);
        }
        if (isset($_GET["sem"])) {
            $semester->setSessionValue($_GET["sem"]);
        }
        //because of new feature
        if (isset($_GET["year"])) {
            if (strlen($_GET["year"])<=0) {
                //set default year
                $ye = "2017";
                $year->setSessionValue($ye);
            } else {
                $year->setSessionValue($_GET["year"]);
            }
        }
        /**
         *  Set hidden values. Call method when all session values are set.
         */
        $nav->setHiddenSessions($lp,$ye,$sem);

        $lp = $teacher->getSessionValue();
        $ye = $year->getSessionValue();
        $sem = $semester->getSessionValue();

        $file = $nav->getNewPath($_GET["file"], $lp, $ye, $sem);
        if (isset($_GET["inc"]) && ($_GET["inc"]==1) ) {
            $content->showWithIncludes($file);
        } else {
            $content->show($file);
        }
    }
    ?>
<script type="application/javascript" src="inc/script/adjust-links.js"></script>

</div> <!-- /container -->
<?php include_once(__DIR__ ."/inc/footer.inc"); ?>

</body>
</html>
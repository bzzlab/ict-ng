<?php
require_once(__DIR__ . '/lib/SessionIO.php');
require_once(__DIR__ . '/lib/Navigation.php');
//start new session
$sess = new SessionIO();
//init message
$msg = "";
//init navigation
$nav = new Navigation();
if (isset($_GET["clear"])){
    if ($_GET["clear"]=="all"){
        $nav->clearSettings("all");
    }
} else {
    $nav->readSettings();
}

if (isset($_POST["Go"])) {
    if ($_POST["Go"] == "Go") {
            $year = $_POST['selYear'];
            if (intval($year) > 0){
                if (!$nav->redirectBySettings($year)){
                    $msg = sprintf("Ein interner Fehler bei der Jahrgangsauwahl ist entstanden.", $year) ;
                }
            } else {
                $msg = sprintf("Bitte wählen Sie einen Jahrgang!", $year) ;
            }
    }
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include_once("inc/head.inc"); ?>
</head>
<body>
<div id="main" class="container-fluid" role="main">
    <div id="carouselFront" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="inc/img/front-01.png" class="d-block w-100" alt="...">
            </div>
           <!-- <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>-->
        </div>
    </div>
    <h2 class="front-h2">Informatik</h2>
    <h4 class="front-h4">Informatik-Unterricht für den Beruf <br/>Mediamatiker/-innen EFZ am
        <a href="http://www.bzz.ch" target="_blank">BZZ</a>.</h4>
    <form id="frmYear" method="post" action="index.php">
        <div class="form-group">
            <label for="selYear">Mediamatiker Jahrgang</label>
            <select class="form-control" name="selYear" id="selYear">
                <option value="none">Wählen Sie Ihren Klassen-Jahrgang.</option>
                <option value="2016">Jahrgang 16 (BIVO 11)</option>
                <option value="2017">Jahrgang 17 (BIVO 11)</option>
                <option value="2018">Jahrgang 18 (BIVO 11)</option>
                <option value="2019">Jahrgang 19 (BIVO 19)</option>
                <option value="2020">Jahrgang 20 (BIVO 19)</option>
            </select>
        <div>
<!--        <div class="form-group form-check">-->
<!--            <input type="checkbox" class="form-check-input" id="chkSaveUrl" name="chkSaveUrl" value="saveUrl"/>-->
<!--            <label class="form-check-label" for="chkSaveUrl">Save settings</label>-->
<!--        </div>-->
        <div style="padding-top: 1rem">
            <input type="submit" class="btn btn-primary" name="Go" value="Go">
        </div>

    </form>
    <!-- Ausgabe Meldung   -->
    <p style="color: #ff4a4a"><?=$msg?></p>
    </div>
</div>

</body>
</html>
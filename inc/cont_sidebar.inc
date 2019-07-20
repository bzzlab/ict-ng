<?php
require_once(__DIR__.'/../lib/Content.php');
$content = new Content();
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Overview
                        <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-title">Variabeln</li>
                <ul class="nav-subelement">Scope
                    <li><a href="#" onclick="showContent('.content_side.php?file=themen/es6/01.md');" return
                           false;>let</a></li>
                </ul>
                <ul class="nav-subelement">Funktionen
                    <li><a href="content_side.php?file=themen/es6/02.md">Arrow</a></li>
                </ul>
                <li><a href="#">Iterationen</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <!--      <h1 class="page-header">Dashboard</h1>-->
            <!--      <h2 class="sub-header">Section title</h2>-->
            <?php
            if (isset($_GET["file"])){
                $content->show($_GET["file"]);
            }
            include_once("footer.inc");
            ?>
        </div>
    </div>
</div>
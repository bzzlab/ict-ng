<?php
require_once(__DIR__ . '/lib/ContentView.php');
$contentView = new ContentView();
$contentView->showExamTests();
/*
$content = "";
if (isset($_GET["file"])) {
	$lp = $teacher->getSessionValue();
    $file = Navigation::getNewPath($_GET["file"], $lp, null,null);
    $content = file_get_contents($file);
    if (isset($_GET["style"])) {
    	$file2 = Navigation::getNewPath($_GET["style"], $lp, null,null);
        $content = str_replace("style.css", $file2, $content);
    }
    if (isset($_GET["script"])) {
    	$file2 = Navigation::getNewPath($_GET["script"], $lp, null,null);
        $content = str_replace("script.js", $file2, $content);
    }
    if (isset($_GET["text"])) {
    	$file2 = Navigation::getNewPath($_GET["text"], $lp, null,null);
        $content = file_get_contents($file2);
    }
}
//dump content
printf("%s",$content);
*/
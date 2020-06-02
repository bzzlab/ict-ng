<?php
require_once(__DIR__ . '/lib/Semester.php');
require_once(__DIR__ . '/lib/Teacher.php');
require_once(__DIR__ . '/lib/Navigation.php');
$nav = new Navigation();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php //include_once("inc/head.inc"); ?>
    <link href="inc/vendor/prism/prism.css" rel="stylesheet" data-noprefix>
</head>
<body>
<?php
$lp = (new Teacher())->getValue();
$ye = (new Year())->getValue();
$sem = (new Semester())->getValue();

if (isset($_GET["file"])) {
    $preStyle = "class=\"line-numbers\" data-src=\"inc/vendor/prism/prism-line-numbers.js\"";
    $codeStyle ="class=\"language-javascript\"";

    $file = $nav->getNewPath($_GET["file"], $lp, $ye,$sem);

    if (isset($_GET["style"])) {
        $style = $_GET["style"];
        if ($style == "exam") {
            //for exams to show possible solutions
            printf("<pre><code>%s</code></pre>",
            htmlspecialchars(file_get_contents($file)));
        } else {
            //when style=css
            //printf("<pre><code class='%s'>%s</code></pre>",
            //    $style, htmlspecialchars(file_get_contents($file)));

            $tmpstyle =sprintf("class=\"language-%s\"",$style);
            printf("<pre %s><code %s>%s</code></pre>", $preStyle, $tmpstyle,
                htmlspecialchars(file_get_contents($file)));
        }
    }
    else {
        printf("<pre %s><code %s>%s</code></pre>", $preStyle, $codeStyle,
            htmlspecialchars(file_get_contents($file)));
    }
}
$browser_link = sprintf("So sieht es im <a href='%s' target='tab'>Browser</a> aus.",$file);

if (isset($_GET["browser"])) {
    if ($_GET["browser"]=="no") { 
        /* keinen Linke für den Browser anzeigen */
        $browser_link="";
    }
}

if (isset($_GET["file2"])) {
    //$lp = $teacher->getSessionValue();
    $file2 = $nav->getNewPath($_GET["file2"], $lp, $ye,$sem);
    $browser_link = sprintf("So sieht es im <a href='%s' target='tab'>Browser</a> aus.",$file2);
}

printf("<p>%s</p>",$browser_link);
?>

<script src="inc/vendor/prism/prism.js"></script>
<script src="inc/vendor/prism/prism-line-numbers.js"></script>

</body>
</html>
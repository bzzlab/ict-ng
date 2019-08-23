<?php
require_once(__DIR__ . '/lib/Content.php');
require_once(__DIR__ . '/lib/Teacher.php');
require_once(__DIR__ . '/lib/Semester.php');
require_once(__DIR__ . '/lib/Year.php');
require_once(__DIR__ . '/lib/Navigation.php');
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <?php include_once("inc/head.inc"); ?>
    <script>
        function show(elements, specifiedDisplay) {
            var computedDisplay, element, index;

            elements = elements.length ? elements : [elements];
            for (index = 0; index < elements.length; index++) {
                element = elements[index];

                // Remove the element's inline display styling
                element.style.display = '';
                computedDisplay = window.getComputedStyle(element, null).getPropertyValue('display');

                if (computedDisplay === 'none') {
                    element.style.display = specifiedDisplay || 'block';
                }
            }
        }
    </script>
</head>
<body>

<div class="container theme-showcase" role="main">

    <?php
    //fix new lp
    if (isset($_GET["file"])) {
        $lp = (new Teacher())->getValue();
        $ye = (new Year())->getValue();
        $sem = (new Semester())->getValue();
        $nav = new Navigation();

        $file = $nav->getNewPath($_GET["file"],$lp,$ye,$sem);

        if (strlen($file) > 0) {
            $content = new Content();
            $content->show($file);
            echo "<script>show(document.querySelectorAll('.solution'));</script>";
        }
    }
    ?>


</div>
</body>
</html>
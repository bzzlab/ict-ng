<?php
require_once(__DIR__.'/../lib/Content.php');
$content = new Content();
?>
<div class="container theme-showcase" role="main">
    <?php
    if (isset($_GET["file"])){
        $file = $_GET["file"];

        $content->show($file);
    }
    ?>
</div> <!-- /container -->
<?php include_once("footer.inc"); ?>

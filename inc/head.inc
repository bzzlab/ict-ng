<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="Mediamatiker EFZ, Bildungszentrum Zürichsee, Horgen">
<meta name="author" content="daniel.garavaldi@bzz.ch">
<!-- Bootstrap -->
<?php
require_once(__DIR__ . '/../lib/Navigation.php');
$nav = new Navigation();
echo $nav->getSiteTitle();
?>
<link href="inc/vendor/bootstrap/4.3.1/css/bootstrap.css" rel="stylesheet">
<script src="inc/vendor/jquery/jquery-3.2.1.js"></script>
<script src="inc/vendor/bootstrap/4.3.1/js/bootstrap.bundle.js"></script>
<link href="inc/vendor/highlight/css/highlight.agate.css" media="screen" rel="stylesheet"/>
<script type="text/javascript" src="inc/vendor/highlight/js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

<!-- Custom styles for this template -->
<link href="inc/theme.css" rel="stylesheet">
<!-- Custom scripts (JavaScripts) for this template -->
<script src="inc/script/ui.js" type="text/javascript"></script>

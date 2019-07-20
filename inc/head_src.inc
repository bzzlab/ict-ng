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
<link href="vendor/bootstrap/4.3.1/css/bootstrap.css" rel="stylesheet">
<script src="vendor/jquery/jquery-3.2.1.js"></script>
<script src="vendor/bootstrap/4.3.1/js/bootstrap.bundle.js"></script>
<link href="vendor/highlight/css/highlight.agate.css" media="screen" rel="stylesheet"/>
<script type="text/javascript" src="vendor/highlight/js/highlight.pack.js"></script>

<!-- Custom styles for this template -->
<link href="theme.css" rel="stylesheet">
<script>hljs.initHighlightingOnLoad();hljs.initLineNumbersOnLoad();</script>
<!-- Custom styles for this template -->
<style>
body {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 14px;
	line-height: 1.42857143;
	color: #333;
	background-color: #fff;
}

/* for block of numbers */
td.hljs-ln-numbers {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;

    text-align: center;
    color: #ccc;
    border-right: 1px solid #CCC;
    vertical-align: top;
    padding-right: 5px;

    /* your custom style here */
}

/* for block of code */
td.hljs-ln-code {
    padding-left: 15px;
}

</style>
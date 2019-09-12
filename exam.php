<?php
require_once(__DIR__ . '/lib/ContentView.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>LB-Beilage</title>
    <meta charset="UTF-8">
    <?php include_once(__DIR__ . "/inc/head.inc"); ?>
    <script type="application/javascript" src="inc/script/handlebars-v4.0.11.js"></script>
    <link href="inc/exam.css" rel="stylesheet">
    <link href="inc/vendor/prism/prism.css" rel="stylesheet" data-noprefix>
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav" style="float:right;">
                <li><button type="button" class="btn btn-link" onclick="history.back(-1)">Zurück</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!--show ONE HTML-Code WITHOUT image-->
<script id="tpl-web1" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Ausgangslage</h3>
    <figure>
        <iframe class="example"  scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{code}}&browser={{browser}}">
            <p>Your browser does not support iframes.</p></iframe>
    </figure>
</script>

<!--show only image-->
<script id="tpl-img1" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Ausgangslage</h3><figure>
        <img class="{{size}}" src="{{path}}/{{file}}"/></figure>
</script>

<!--show ONE HTML-Code WITH image-->
<script id="tpl-web2" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Ausgangslage</h3>
    <!-- Lösungen  -->
    <div class="flex-container">
        <!-- Teil-Lösungen  -->
        <figure>
            <iframe class="example" style="{{style_code}};" scrolling="no" onload="resizeIframe(this)"
                    src="view_code2.php?file={{path}}/{{code}}&browser=no">
                <p>Your browser does not support iframes.</p></iframe>
        </figure>
        <figure><img style="{{style_img}};" src="{{path}}/{{image}}"/></figure>
    </div>
</script>
<script id="tpl-web2-v2" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Ausgangslage</h3>
    <!-- Lösungen  -->
    <div class="flex-container">
        <!-- Teil-Lösungen  -->
        <figure>
            <iframe class="example" style="{{style_code}};" scrolling="no" onload="resizeIframe(this)"
                    src="view_code2.php?file={{path}}/{{code}}&browser=no">
                <p>Your browser does not support iframes.</p></iframe>
        </figure>
        <figure><figcaption>{{img_label}}</figcaption><img style="{{style_img}};" src="{{path}}/{{image}}"/></figure>
    </div>
</script>

<!--show ONE HTML-Code WITH-OUT image and WITH possible solutions -->
<script id="tpl-web2-v3" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Ausgangslage</h3>
    <!-- Lösungen  -->
    <div class="flex-container">
        <!-- Teil-Lösungen  -->
        <figure>
            <iframe class="example" style="{{style_code}};" scrolling="no" onload="resizeIframe(this)"
                    src="view_code2.php?file={{path}}/{{code}}&browser=no">
                <p>Your browser does not support iframes.</p></iframe>
        </figure>
        <!-- Possible solutions  -->
        <form>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="solutions">{{sol_label}}</label>
                </div>
                <select class="custom-select" id="solutions">
                    <option selected>Bitte wählen...</option>
                    <option value="1">{{sol1}}</option>
                    <option value="2">{{sol2}}</option>
                    <option value="3">{{sol3}}</option>
                    <option value="4">{{sol4}}</option>
                </select>
            </div>
        </form>

    </div>
</script>

<!--show TWO HTML-Codes WITHOUT image-->
<script id="tpl-web3" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Ausgangslage</h3>
    <!-- Lösungen  -->
    <div class="flex-container">
        <!-- Teil-Lösungen  -->
        <figure>
            <iframe class="example" style="{{style_code1}};" scrolling="no" onload="resizeIframe(this)"
                    src="view_code2.php?file={{path}}/{{code1}}&browser=no">
                <p>Your browser does not support iframes.</p></iframe>
        </figure>
        <figure>
            <iframe class="example" style="{{style_code2}};" scrolling="no" onload="resizeIframe(this)"
                    src="view_code2.php?file={{path}}/{{code2}}&browser=no">
                <p>Your browser does not support iframes.</p></iframe>
        </figure>
        <figure><img style="{{style_img}};" src="{{path}}/{{image}}"/></figure>
    </div>
</script>

<!--show four possible solutions-->
<script id="tpl-sol1" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Mögliche Lösungen</h3>
    <!-- Lösungen  -->
    <div class="flex-container">
        <!-- Teil-Lösungen  -->
        <iframe class="example" style="width:{{w1}};"
                scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{a1}}&browser=no">
            <p>Your browser does not support iframes.</p>
        </iframe>
        <iframe class="example" style="width:{{w1}};"
                scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{a2}}&browser=no">
            <p>Your browser does not support iframes.</p>
        </iframe>
        <iframe class="example" style="width:{{w1}};"
                scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{a3}}&browser=no">
            <p>Your browser does not support iframes.</p>
        </iframe>
        <iframe class="example" style="width:{{w1}};"
                scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{a4}}&browser=no">
            <p>Your browser does not support iframes.</p>
        </iframe>
    </div>
</script>

<!--show one possible solutions-->
<script id="tpl-sol2" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Mögliche Lösungen</h3>
    <figure>
        <iframe class="example"  scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{file}}&browser=no">
            <p>Your browser does not support iframes.</p></iframe>
    </figure>
</script>

<!--test solutions with image-->
<script id="tpl-test1" type="text/x-handlebars-template">
  <div class="clear"></div>
  <div class="besideBoxes">
    <div class="box1">
      <h4>Aufgabe - {{aufg}} -
          <a style="font-size:80%;" id="{{aufg}}_link" target="_link"
             href="load.php?file={{path}}/{{file}}">Browser</a>
          <button style="font-size:80%;" id="{{aufg}}_enlarge">enlarge</button>
      </h4>
      <iframe id="{{aufg}}_content" scrolling="no"
      onload="resizeIframe(this)" 
      src="load.php?file={{path}}/{{file}}">
      <p>Your browser does not support iframes.</p></iframe>
    </div>
   <div id="{{aufg}}_box2" class="box2">
      <h4>Vorgabe</h4>
      <figure>
        <img width="medium" src="{{path}}/{{image}}"/>
      </figure>
   </div>
    <!-- possible solutions -->
    <div id="{{aufg}}_box3" class="box3">
       <h4 class="{{aufg}}_selected">Lösungswahl</h4>
        <button id="{{aufg}}_01">{{l1}}</button>&nbsp;
        <button id="{{aufg}}_02">{{l2}}</button>&nbsp;
        <button id="{{aufg}}_03">{{l3}}</button>&nbsp;
        <button id="{{aufg}}_04">{{l4}}</button>&nbsp;
        <pre><code class="{{aufg}}_text"></code></pre>
      </div>
  </div>
</script>

<script id="tpl-test1-v2" type="text/x-handlebars-template">
  <div class="clear"></div>
  <div class="besideBoxes">
    <div class="box1">
      <h4>Aufgabe - {{aufg}} -
          <a style="font-size:80%;" id="{{aufg}}_link" target="_link"
             href="load.php?file={{path}}/{{file}}">Browser</a>
          <button style="font-size:80%;" id="{{aufg}}_enlarge">enlarge</button>
      </h4>
      <iframe id="{{aufg}}_content" scrolling="no"
      onload="resizeIframe(this)"
      src="load.php?file={{path}}/{{file}}">
      <p>Your browser does not support iframes.</p></iframe>
    </div>
   <div id="{{aufg}}_box2" class="box2">
      <h4>Vorgabe</h4>
      <figure>
        <img width="medium" src="{{path}}/{{image}}"/>
      </figure>
   </div>
    <!-- possible solutions -->
    <div id="{{aufg}}_box3" class="box3">
       <h4 class="{{aufg}}_selected">Lösungswahl</h4>
        <button id="{{aufg}}_01{{ext}}">{{l1}}</button>&nbsp;
        <button id="{{aufg}}_02{{ext}}" datatype="{{filetype}}">{{l2}}</button>&nbsp;
        <button id="{{aufg}}_03{{ext}}" datatype="{{filetype}}">{{l3}}</button>&nbsp;
        <button id="{{aufg}}_04{{ext}}" datatype="{{filetype}}">{{l4}}</button>&nbsp;
        <pre><code class="{{aufg}}_text"></code></pre>
      </div>
  </div>
</script>

<!--test solutions with html-code-->
<script id="tpl-test2" type="text/x-handlebars-template">
  <div class="clear"></div>
  <div class="besideBoxes">
   <h4>Aufgabe - {{aufg}}</h4>
   <div id="{{aufg}}_box2" class="box2">
      <h4>Lösung</h4>
       <figure>
           <iframe class="example"  scrolling="no" onload="resizeIframe(this)"
                   src="{{path}}//{{file}}">
               <p>Your browser does not support iframes.</p></iframe>
       </figure>
   </div>
  <!-- possible solutions -->
  <div id="{{aufg}}_box3" class="box3">
      <h4 class="{{aufg}}_selected">Lösungswahl</h4>
      <button id="{{aufg}}_01{{ext}}">{{l1}}</button>&nbsp;
      <button id="{{aufg}}_02{{ext}}" datatype="{{filetype}}">{{l2}}</button>&nbsp;
      <button id="{{aufg}}_03{{ext}}" datatype="{{filetype}}">{{l3}}</button>&nbsp;
      <button id="{{aufg}}_04{{ext}}" datatype="{{filetype}}">{{l4}}</button>&nbsp;
      <pre><code class="{{aufg}}_text"></code></pre>
  </div>
  </div>
</script>

<div class="container theme-showcase" role="main">
    <a name="top"></a>
    <div class="jumbotron">
        <h2></h2>
    </div>
    <div id="index-container"></div>
    <div id="code-container"></div>

    <?php
    $contentView = new ContentView();
    $contentView->showExam();
    ?>
</div> <!-- /container -->

<?php include_once(__DIR__ ."/inc/footer.inc"); ?>
<script type="application/javascript" src="inc/script/adjust-links.js"></script>
<script src="inc/vendor/prism/prism.js"></script>
<script src="inc/vendor/prism/prism-line-numbers.js"></script>
</body>
</html>
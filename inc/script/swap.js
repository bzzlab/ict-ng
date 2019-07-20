function resizeIframe(iframe) {
    var delta = 0;
    if (navigator.userAgent.match("Chrome")) {
        delta = 26; //Korrektur bei Chrome-Browser
    }
    iframe.height = (iframe.contentWindow.document.body.scrollHeight+delta) + "px";
}

function resizeIframeWidth(iframe,width) {
    var delta = 0;
    if (navigator.userAgent.match("Chrome")) {
        delta = 26; //Korrektur bei Chrome-Browser
    }
    iframe.height = (iframe.contentWindow.document.body.scrollHeight+delta) + "px";
    if (width != null) {
        iframe.width = width + "px"; 
    }
    //console.log("iframe.height:" + iframe.height);
    //console.log("iframe.width:" + iframe.width);
}

function loadFrame(where, url) {
    document.getElementById(where).setAttribute("src",url);
}

const aufgPath = "../aufg/";
function getUrl(htmlFile, style) {
    return "load.php?file="+aufgPath+htmlFile+"&style="+aufgPath+style;
}

function addStyleToUrl(url, style) {
    return url+"&style="+style;
}

function getPath(res) {
    return aufgPath+res;
}

function getUrlFromIframe(domId) {
    var x = null;
    x = document.getElementById(domId).getAttribute("src");
    return x;
}

/* Check if a substring is contained in a (larger) string */
function isInString(substring) {
    var str = "Hello world, welcome to the universe.";
    /* check starting from character 12 */
    //var n = str.includes(substring, 12);
    return str.includes(substring);
    //document.getElementById("demo").innerHTML = n;
}



/* Main starting program */
$(document).ready(function() {
    $("button").click(function(e){
        /* e.target.id returns the element-id of the pressed html-element. 
         * trick: concatenate element-id with the css-extension
         */
        //sets the color of the button
        $('button.red').removeClass('red')
        $(this).addClass('red');

        /* determine css-style-file based on the selected button-id, 
         * which are <button id="a1_01, a1_02, a1_03, ...">a1_01 (L)</button>&nbsp;
         */ 
        var style = e.target.id+".css";
        var selectedButtonId = e.target.id;
        var prefix = style.substring(0, 3);
        
        //ICT-02_LB03
        /* var startSites = ["a1_00_start.html", "a4_00_start.html", "a5_00_start.html", 
                "a6_00_start.html", "a7_00_start.html", "a8_00_start.html", "a9_00_start.html",
                 "b1_00_start.html"];
        */



        var startSitesLength = startSites.length;
        /* 
        * Determine the path of the iframe with the 
        * 1) prefix a1_, a2_, a3_ ... and 
        * 2) the suffix "content" 
        * that corresponds with the iframe-ID 
        */
        var url = $("#"+prefix+"content").attr('src');
        for (var i=0; i < startSitesLength; i++) {
            //check, if url is in the startSites array
            if (url.search(startSites[i]) >= 0){
                break;
            }

            if (i == (startSitesLength-1)){
                alert("Url "+url+" not found!");
            }
        }
        

        
        /* load selected solution into code-element <pre><code class="a1_text, a2_text ..."></code></pre>
         */ 
        var stylePath = getPath(style);
        $("."+prefix+"text").load(stylePath);
        //load source code into frame and show solution
        var url_and_style = addStyleToUrl(url, stylePath);

        loadFrame(prefix+"content",url_and_style);
    });
});
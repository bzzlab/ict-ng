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
    if (navigator.userAgent.match("Firefox")) {
        delta = 120; //Korrektur bei Firefox-Browser
    }
    iframe.height = (iframe.contentWindow.document.body.scrollHeight+delta) + "px";
    if (width != null) {
    	iframe.width = width + "px"; 
    }
    //console.log("iframe.height:" + iframe.height);
    //console.log("iframe.width:" + iframe.width);
}



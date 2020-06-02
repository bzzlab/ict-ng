//filter specific images whose path shouldn't be changed
function filterImages(src){
    //filter the following images
    let filterList = ["zoom-in", "video", "red.ico", "yellow.ico", "draft.png"];
    for (let i in filterList) {
        if (src.includes(filterList[i])){
            return true;
        }
    }
    return false;
}

/**
 * Adjust source path according to the input parameter
 *
 * @param obj: targeting html-element
 * @param attribute: targeting html-attribute
 * @param src: Path attribute
 */
function setPath(obj,attribute,src){
    //set teacher

    let lp = $("#lp_key").val();
    if (lp == "") {
        console.log("lp is empty!");
    }
    //set year
    let year = $("#year_key").val();
    if (year == "") {
        console.log("year is empty!");
    }
    //set semester
    let sem = $("#sem_key").val();
    if (sem == "") {
        console.log("sem is empty!");
    } else {
        $(obj).attr(attribute, "data/"+lp+"/"+year+"/"+sem+"/"+src);
        console.log("Path adjusted: data/"+lp+"/"+year+"/"+sem+"/"+src);
    }
}

$(document).ready(function() {
    console.time('adjust links');
    console.log(`adjustlink - lp=${document.getElementById("lp_key").value},year=${document.getElementById("year_key").value},sem=${document.getElementById("sem_key").value}`);
    //select all <src> in <img> and change href accordingly
    let images = $("img");
    $.each(images, function() {
        let path = $(this).attr("src");
        //Filter: check if specific images' paths shouldn't be changed
        if (filterImages(path) === false) {
            //if src does not contain the path-part data, then ...
            if (!path.includes("data")) {
                setPath($(this),"src",path);
            }
        }
    });


    //select all anchor <a> in <figcaption> and change href accordingly
    images = $("figcaption a");
    $.each(images, function() {
        let attributeType = "href";
        let path = $(this).attr(attributeType);
        if (!path.includes("data")) {
            setPath($(this),attributeType,path);
        }
    });


    //select all anchor <a> in <p> and change href accordingly
    //this adjustment should be used only for
    let link = $("a[name='video'], a[name='download'], a[name='document']");
    $.each(link, function() {
        let attributeType = "href";
        let path = $(this).attr(attributeType);
        if (path!==undefined){
            if (!path.includes("data") && (!path.includes("content.php"))) {
                setPath($(this),attributeType,path);
            }
        }
    });

    //select all source <source> in <video> and change src-attribute accordingly
    let video = $("video");
    $.each(video, function() {
        let attributeType = "src";
        let path = $(this).attr(attributeType);
        if (path!=null){
            if (!path.includes("data")) {
                setPath($(this),attributeType,path);
            }
        }
    });
    console.timeEnd('adjust links');
    //console.clear();
});
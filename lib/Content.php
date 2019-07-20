<?php
require_once(__DIR__ . '/Parsedown.php');

/**
 * Created by PhpStorm.
 * User: dgar
 * Date: 07.07.17
 * Time: 12:25
 */
class Content
{

    private $parsedown = null;

    /**
     * Content constructor.
     */
    public function __construct()
    {
        $this->parsedown = new Parsedown();
    }


    public function showWithIncludes($file)
    {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $dir = pathinfo($file, PATHINFO_DIRNAME);
        if (strpos($extension, "md") !== false) {

            $txt_file = file_get_contents($file);
            $lines = explode("\n", $txt_file);
            array_shift($lines);
            //$txt_file = "";

            foreach ($lines as $line) {
                /*
                 * Search all Markdown includes {{inc/01_rep_b.md}}
                 * or {{org/inc/01_rep_b.md}}
                 */
                if (preg_match("/\{\{[^*?\"<>|:]*\}\}/", $line, $resultArray)) {
                    $path = str_replace("{{", "", $resultArray[0]);
                    $path = str_replace("}}", "", $path);

                    //get the part of the reference markdown
                    $markdown = file_get_contents($dir."/".$path);
                    $txt_file = str_replace($resultArray[0], $markdown, $txt_file);
                }
            }

            echo $this->parsedown->text($txt_file);
        }
    }

    public function show($file)
    {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        if (strpos($extension, "md") !== false) {
            echo $this->parsedown->text(file_get_contents($file));
        } else if (strpos($extension, "pdf") !== false) {
            $html = "<div class='embed-responsive'>";
            $html .= "<object data='" . $file . "' type='application/pdf'></object></div>";
            echo $html;
        }
    }
}
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
            /*
            Reproduce problem:
                1. Browser -> Application -> Cookies
                2. Change PHP-Session-ID
                3. Select another Navigation-IT -> Bum -> Blank-Site
                4. Problem Cookies with the essential parameter are not read and session renewed.
            Possible fixes: Try/catch -> https://stackify.com/php-try-catch-php-exception-tutorial/
            Logging: https://www.php.net/manual/en/function.openlog.php or http://logging.apache.org/log4php/
            
            Maybe a better way is to check the session status -> https://www.php.net/manual/en/function.session-status.php
            */
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
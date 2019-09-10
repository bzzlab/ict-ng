<?php
require_once(__DIR__ . '/Teacher.php');
require_once(__DIR__ . '/Semester.php');
require_once(__DIR__ . '/Content.php');
require_once(__DIR__ . '/Navigation.php');
require_once(__DIR__ . '/Year.php');
require_once(__DIR__ . '/enums/ModeTypeEnum.php');
require_once(__DIR__ . '/System.php');

class ContentView
{
    private $content = null;
    private $nav = null;

    /**
     * ContentView constructor.
     */
    public function __construct()
    {
        $this->content = new Content();
        $this->nav = new Navigation();
    }

    public function show(){
        /**
         * This part is used for direct links called outside
         * of this platform.
         */
        if (isset($_GET["file"])) {
            $semester = new Semester();
            $teacher = new Teacher();
            $year = new Year();
            //init variables
            $lp = $teacher->getValue();
            $ye = $year->getValue();
            $sem = $semester->getValue();
            //set hidden data for adjust-links

            //set teacher
            if (isset($_GET["lp"])) {
                $lp = $_GET["lp"];
                if (isset($_GET["mode"]) && ($_GET["mode"] == ModeTypeEnum::Persist)) {
                    $teacher->setSessionValue($_GET["lp"]);
                }
            }

            //set year
            if (isset($_GET["year"])) {
                $ye = $_GET["year"];
                if (isset($_GET["mode"]) && ($_GET["mode"] == ModeTypeEnum::Persist)) {
                    $year->setSessionValue($_GET["year"]);
                }
            }


            //set semester
            if (isset($_GET["sem"])) {
                $sem = $_GET["sem"];
                if (isset($_GET["mode"]) && ($_GET["mode"] == ModeTypeEnum::Persist)) {
                    $semester->setSessionValue($_GET["sem"]);
                }
                $semester->setSessionValue($_GET["sem"]);
            }

            /**
             *  Set hidden values. Call method when all session values are set.
             */
            $this->nav->setHiddenSessions($lp, $ye, $sem);
            //verbose info
            System::console_log(sprintf("content.php: hidden data set -> lp=%s, ye=%s, sem=%s", $lp, $ye, $sem));

            $file = $this->nav->getNewPath($_GET["file"], $lp, $ye, $sem);
            if (isset($_GET["inc"]) && ($_GET["inc"] == 1)) {
                $this->content->showWithIncludes($file);
            }
            elseif (isset($_GET["file-type"]) && ($_GET["file-type"] == "js")) {
                printf("<script type=\"text/javascript\" src='%s'></script>", $file);
            } else {
                $this->content->show($file);
                if (isset($_GET["sol"]) && ($_GET["sol"] == 1)) {
                    echo "<script>showSolution(document.querySelectorAll('.solution'));</script>";
                }
            }
        }
        //set hidden value for javascript (i.e. script/ajustlinks.js)

    }

}
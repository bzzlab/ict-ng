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
    private $lp = null;
    private $ye = null;
    private $sem = null;

    /**
     * ContentView constructor.
     */
    public function __construct()
    {
        $this->content = new Content();
        $this->nav = new Navigation();
    }

    /**
     * Set site paramter (from session or cookies)
     */
    private function setSiteParameters(){
        $semester = new Semester();
        $teacher = new Teacher();
        $year = new Year();
        //init variables
        $this->lp = $teacher->getValue();
        $this->ye = $year->getValue();
        $this->sem = $semester->getValue();

        //set hidden data for adjust-links
        //set teacher
        if (isset($_GET["lp"])) {
            $this->lp = $_GET["lp"];
            if (isset($_GET["mode"]) && ($_GET["mode"] == ModeTypeEnum::Persist)) {
                $teacher->setSessionValue($_GET["lp"]);
            }
        }
        //set year
        if (isset($_GET["year"])) {
            $this->ye = $_GET["year"];
            if (isset($_GET["mode"]) && ($_GET["mode"] == ModeTypeEnum::Persist)) {
                $year->setSessionValue($_GET["year"]);
            }
        }
        //set semester
        if (isset($_GET["sem"])) {
            $this->sem = $_GET["sem"];
            if (isset($_GET["mode"]) && ($_GET["mode"] == ModeTypeEnum::Persist)) {
                $semester->setSessionValue($_GET["sem"]);
            }
            $semester->setSessionValue($_GET["sem"]);
        }

        /**
         *  Set hidden values. Call method when all session values are set.
         */
        $this->nav->setHiddenSessions($this->lp, $this->ye, $this->sem);
        //verbose info
        System::console_log(sprintf("content.php: hidden data set -> lp=%s, ye=%s, sem=%s", $this->lp, $this->ye, $this->sem));
    }

    /**
     * Method used for exam.php
     * TODO: Refactor content.php with this method in order to avoid code-duplication
     */
    public function show(){
        if (isset($_GET["file"])) {
            $this->setSiteParameters();
            $file = $this->nav->getNewPath($_GET["file"], $this->lp, $this->ye, $this->sem);
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
    }

    public function showExam(){
        if (isset($_GET["file"])) {
            $this->setSiteParameters();
            $file = $this->nav->getNewPath($_GET["file"], $this->lp, $this->ye, $this->sem);
            printf("<script type=\"text/javascript\" src='%s'></script>", $file);
        }
    }


    /**
     * Method used when testing code-examples for an exam.
     * Primarily use in load.php for loading different types of codes-files
     */
    public function showExamTests(){
        $content = "";
        if (isset($_GET["file"])) {
            //set first site parameters
            $this->setSiteParameters();
            //fetch the correct path based on lp, ye, sem
            $file = $this->nav->getNewPath($_GET["file"], $this->lp, $this->ye, $this->sem);
            //for debug-purpose
            //echo "<script>console.log(\"lib/ContentView: ".$file."\");</script>";
            $content = file_get_contents($file);
            if (isset($_GET["style"])) {
                $file2 = $this->nav->getNewPath($_GET["style"], $this->lp, $this->ye, $this->sem);
                $content = str_replace("style.css", $file2, $content);
            }
            if (isset($_GET["script"])) {
                $file2 = $this->nav->getNewPath($_GET["script"], $this->lp, $this->ye, $this->sem);
                $content = str_replace("script.js", $file2, $content);
            }
            if (isset($_GET["img"])) {
                $file2 = $this->nav->getNewPath($_GET["img"], $this->lp, $this->ye, $this->sem);
                $content = str_replace("image.svg", $file2, $content);
            }
            if (isset($_GET["text"])) {
                $file2 = $this->nav->getNewPath($_GET["text"], $this->lp, $this->ye, $this->sem);
                $content = file_get_contents($file2);
            }
        }
        //dump content
        printf("%s",$content);
    }

}
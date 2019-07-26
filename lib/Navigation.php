<?php
require_once(__DIR__ . '/SiteURL.php');
require_once(__DIR__ . '/Teacher.php');
require_once(__DIR__ . '/Semester.php');
require_once(__DIR__ . '/Year.php');
require_once(__DIR__ . '/NavDropDown.php');
require_once(__DIR__ . '/NavDropDownList.php');
require_once(__DIR__ . '/NavDropDownExtra.php');

class Navigation
{

    private $site = null;
    private $semester = null;
    private $teacher = null;
    private $year = null;


    /**
     * Navigation constructor.
     */
    public function __construct()
    {
        $this->site = new SiteURL();
        $this->semester = new Semester();
        $this->teacher = new Teacher();
        $this->year = new Year();

    }

    public function clearSettings($type){

        //if ($type == "all" || $type == "cookie"){
            $this->teacher->setCookieValue(CookieIO::INVALID);
            $this->year->setCookieValue(CookieIO::INVALID);
            $this->semester->setCookieValue(CookieIO::INVALID);
        //}

        //if ($type == "all" || $type == "session"){
            $this->teacher->setSessionValue(SessionIO::INVALID);
            $this->year->setSessionValue(SessionIO::INVALID);
            $this->semester->setSessionValue(SessionIO::INVALID);
        //}
    }

    /**
     * @param $year: year of classes (Jahrgang)
     * @return bool: return success or fail
     */
    public function redirectBySettings($year) : bool {
        $yearArray = $this->year->getAllowedValues();
        if (!in_array($year, $yearArray)) {
            return false;
        }
        //get teacher
        $lp = $this->year->getCurrentTeacher($year);
        //get semester or module
        $sem = $this->year->getCurrentSemester($year);

        $lpArray = $this->teacher->getAllowedValues();
        if (!in_array($lp, $lpArray)) {
            return false;
        }
        $semArray = $this->semester->getAllowedValues();
        if (!in_array($sem, $semArray)) {
            return false;
        }

        //set sessions and redirect
        $this->redirect($lp,$year, $sem);
        return true;
    }

    public function setHiddenSessions($lp, $year, $sem){
        if (strlen($lp) > 0){
            echo "<input type='hidden' id='lp_key' value='".$lp."'/>";
        }
        if (strlen($year) > 0){
            echo "<input type='hidden' id='year_key' value='".$year."'/>";
        }
        if (strlen($sem) > 0){
            echo "<input type='hidden' id='sem_key' value='".$sem."'/>";
        }
    }


    public function readSettings() : bool {
        //read teacher (lp) cookie
        $lp = $this->teacher->getCookieValue();
        if ($lp == CookieIO::INVALID) {
            return false;
        }
        //read year cookie
        $year = $this->year->getCookieValue();
        if ($year == CookieIO::INVALID) {
            return false;
        }
        //read semester cookie
        $sem = $this->semester->getCookieValue();
        if ($sem == CookieIO::INVALID) {
            return false;
        }

        /*  All cookies could be read.
         *  Now check if the values are allowed
        */
        $lpArray = $this->teacher->getAllowedValues();
        if (!in_array($lp, $lpArray)) {
            return false;
        }
        $semArray = $this->semester->getAllowedValues();
        if (!in_array($sem, $semArray)) {
            return false;
        }

        //set sessions and redirect
        $this->redirect($lp,$year, $sem);
        return true;
    }

    /**
     * Get the site-title depending of the selected semester
     * @return string: site-tile
     */
    public function getSiteTitle(): string
    {
        $result = "<title>ICT - BZZ</title>";
        //set and check teacher from the session
        if (($ye = $this->year->getSessionValue())
            == SessionIO::INVALID){
            return $result;
        }

        //set and check semester from the session
        if (($sem = $this->semester->getSessionValue())
            == SessionIO::INVALID){
            return $result;
        }
        return sprintf("<title>BZZ-ICT-%s/%s</title>", $sem,$ye);
    }

    /**
     * Set top navigation
     * @return array
     */
    public function getTopNavigationSites()
    {
        $lp = $this->teacher->getSessionValue();
        $ye = $this->year->getSessionValue();
        $sem = $this->semester->getSessionValue();
        $base_url = sprintf("content.php?file=data/%s/%s/%s/org",$lp,$ye,$sem);
        $topNavList = array("Home" => $base_url . "/home.md",
            "Agenda" => $base_url . "/agenda.md",
            "Organisation" => $base_url . "/organisation.md");

        //Change url for specific semester
        if(strcmp($sem, "08")==0 || strcmp($sem, "04")==0 ||
            strcmp($sem, "07")==0 || strcmp($sem,"03")==0){
            $topNavList["Agenda"] = sprintf("content.php?inc=1&file=data/%s/%s/%s/org/agenda.md",$lp,$ye,$sem);;
        }

        if((strcmp($sem, "05")==0))
        {
            //remove the last element
            //array_pop($topNavList);
            //add element for Musterlösung
            $topNavList += ["Lösungen" => $base_url . "/loesungen.md"];
        }

        if((strcmp($sem, "pw01")==0))
        {
            $base_url = sprintf("content.php?file=data/%s/%s/%s/org",$lp,$ye,$sem);
            $topNavList = array("Home" => $base_url . "/home.md",
            "FAQ" => $base_url . "/faq.md",
            "Agenda" => $base_url . "/agenda.md",
            "Gruppen" => $base_url . "/gruppen.md",
            "Themen" => $base_url . "/projektthemen.md");
        }

        if((strcmp($sem, "m286")==0))
        {
            $base_url = sprintf("content.php?file=data/%s/%s/%s/org",$lp,$ye,$sem);
            $topNavList = array("Home" => $base_url . "/home.md",
                "Organisation" => $base_url . "/organisation.md");
        }
        return $topNavList;
    }


    /**
     * @return array: List of navigation-items in the dropdown
     */
    //TODO: Refactor with NavDropDown + NavDropDownList
    public function getDropDownMore()
    {
        $lp = $this->teacher->getSessionValue();
        $ye = $this->year->getSessionValue();
        $sem = $this->semester->getSessionValue();
        $base_url = sprintf("content.php?file=data/%s/%s/%s/org",$lp,$ye,$sem);

        //init ddl-nav-list
        $_List = array();
        $_ddlExtra = new NavDropDownExtra();

        //add basic links into the "More"-navigation
        array_push($_List,
            new NavDropDown("Jahrgang","index.php?clear=all", $_ddlExtra ));
        array_push($_List,
            new NavDropDown("Selfhtml","https://wiki.selfhtml.org", $_ddlExtra ));
        array_push($_List,
            new NavDropDown("Can I use","http://caniuse.com/", $_ddlExtra));


        if((strcmp($sem, "pw01")==0))
        {
            //clear navigation list
            unset($_List);
            array_push($_List,
                new NavDropDown("Organisation",$base_url . "/organisation.md", $_ddlExtra ));
            array_push($_List,
                new NavDropDown("Unterlagen",$base_url . "/unterlagen.md", $_ddlExtra ));

        }

        if ((strcmp($sem, "06")==0))
        {
            //remove the last element
            //array_pop($topNavList);
            //add element for Musterlösung
            array_push($_List,
                new NavDropDown("MySQL Commands","https://www.tutorialspoint.com/mysql/index.htm", $_ddlExtra));
        }
        return new NavDropDownList($_List, "More");
    }


    //Todo: Create custom link object in order to print special styles and html-code
    public function setLinksOfTopNavigation()
    {
        $part = $this->site->getPartFromURL(SiteURL::QUERY);
        $siteList = $this->getTopNavigationSites();
        //to highlight the selected menu-item
        foreach ($siteList as $siteCaption => $siteUrl) {
            if ($this->site->contains(strtolower($siteCaption), $part)) {
                //NavLink(NavTypeEnum::
                printf("<li class=\"nav-item active\"><a class=\"nav-link\" href='%s'>%s</a></li>", $siteUrl, $siteCaption);
            } else {
                printf("<li class=\"nav-item\"><a class=\"nav-link\" href='%s'>%s</a></li>", $siteUrl, $siteCaption);
            }
        }
    }


    private function getDropDownSemester() : NavDropDownList{
        $lp = $this->teacher->getSessionValue();
        $ye = $this->year->getSessionValue();
        $sem = $this->semester->getSessionValue();

        //set current semester that is set in Year -> settings
        if (strlen($currentSemester = $this->year->getCurrentSemester($ye)) <= 0){
            $currentSemester = $sem;
        }
        //init ddl-nav-list
        $_List = array();

        for($i=1;$i<9;$i++){
            /* Important: create new NavDropDownExtra here (and not before the loop)
               in order to initialize correct the extras
            */
            $_ddExtra = new NavDropDownExtra();
            //if $current semester is equal index $i then skip adding url
            if((strcmp($currentSemester, sprintf('%02d',$i))==0)) {
                $_ddExtra->setBadge("badge badge-info");
                $_ddExtra->setTooltip("Ihr Semester in diesem Lehrjahr");
            }
            array_push($_List, new NavDropDown(sprintf('Sem-%02d',$i),
                sprintf("content.php?sem=0%s&inc=1&file=data/%s/%s/0%s/org/agenda.md",
                    $i,$lp,$ye,$i), $_ddExtra));

        }

        return new NavDropDownList($_List, "Semester");
    }

    public function writeDropDownSemester(){
        $sem = $this->semester->getValue();
        //don't show semester ddl for BIVO 2019
        if(!(strcmp($sem, "m286")==0))
        {
            printf("%s", $this->getDropDownSemester()->write());
        }
    }

    public function writeDropDownMore(){
        printf("%s", $this->getDropDownMore()->write());
    }




//    //TODO: Refactor
//    public function setDropDownMenuNavigation()
//    {
//        $siteList = $this->getDropDownMenuSites();
//        foreach ($siteList as $siteCaption => $siteUrl) {
//            printf("<a class=\"dropdown-item\" href='%s'>%s</a>", $siteUrl, $siteCaption);
//        }
//    }

    /**
     * Set different top navigations with include files
     * @return mixed
     */
    public function setTopNavigation()
    {
        $nav = array("inc/nav.inc", "inc/nav_cont.inc");
        $result = 0; //default
        if (isset($_GET["top"])) {
            switch ($_GET["top"]) {
                case 1:
                    $result = 1;
                    break;
            }
        }
        return $nav[$result];
    }

    /**
     * Determine the physical path to the specific teacher (lp)
     * @param $file - path to be edited
     * @param $lp - teachercode lp01,lp02, ...
     * @param $year - year of class
     * @param $sem - module (as semester) m152, m150, ...
     * @return string - return new path
     */
    public function getNewPath($file, $lp, $year, $sem): string
    {
        if (strpos($file, "data/") === false) {
            $tmp = sprintf("data/%s/%s/%s/%s", $lp, $year,$sem,$file) ;
            $file = str_replace("//", "/", $tmp);
        }
        return $file;
    }

    /**
     * Setze Links-Navigation abhängig vom Content
     * @return mixed
     */
    public function setLeftNavigation()
    {
        $nav = array("inc/cont.inc", "inc/cont_sidebar.inc");
        $result = 0; //default
        if (isset($_GET["ct"])) {
            switch ($_GET["ct"]) {
                case 1:
                    $result = 1;
                    break;
            }
        }
        return $nav[$result];
    }

    /**
     * Redirect with teacher, year and semester
     * @param $lp: Teacher code
     * @param $ye: Year code
     * @param $sem: Semester code
     *
     */
    public function redirect($lp, $ye, $sem)
    {
        /*$this->teacher->setSessionValue($teacher);
        $this->year->setSessionValue($year);
        $this->semester->setSessionValue($semester);*/

        $this->teacher->setValue($lp);
        $this->year->setValue($ye);
        $this->semester->setValue($sem);

        $url = sprintf("Location: content.php?inc=1&file=data/%s/%s/%s/org/agenda.md",
            $lp, $ye, $sem);
        header($url);
        //die(0);
    }

}
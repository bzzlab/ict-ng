<?php
require_once(__DIR__ . '/CookieIO.php');
require_once(__DIR__ . '/SessionIO.php');
require_once(__DIR__ . '/Konstanten.php');
//require_once(__DIR__ . '/Teacher.php');

/**
 * Created by PhpStorm.
 * User: dgar
 * Date: 06.07.17
 * Time: 20:39
 */
class Semester
{

    private $cookieIO = null;
    private $sess = null;
    //private $teacher = null;

    const ENTITY_ID = "sem";
    //const SUBMIT_VAL = "Continue";
    //const SUBMIT_ID = "contStep02";


    /**
     * Semester constructor.
     */
    public function __construct()
    {
        $this->cookieIO = new CookieIO();
        $this->sess = new SessionIO();
        //$this->teacher = new Teacher();
    }


    /*public function processForm(){
        if (isset($_POST[self::ENTITY_ID])) {
            $sem = $_POST[self::ENTITY_ID];
            $lp = $this->teacher->getSessionValue();
            if ($lp == SessionIO::INVALID) {
                header("Location: index.php");
            }
            $this->setSessionValue($sem);
            if (isset($_POST["cookie"])){
                if ($_POST["cookie"]  == "true"){
                    $this->setCookieValue($sem);
                    $this->teacher->setCookieValue($lp);
                }
            }
            Navigation::redirect($lp, $sem);
        }
    }*/


//    public function dumpValues(){
//        printf("teacher, cookie: %s, session: %s<br/>",
//            $this->teacher->getCookieValue(),$this->teacher->getSessionValue());
//
//        printf("Semester, cookie: %s, session: %s<br/>",
//            $this->getCookieValue(),$this->getSessionValue());
//    }

    /**
     * All possible semester
     * @return array
     */
    public function getAllowedValues(){
        //Return all possible semester
        return array("01", "02", "03", "04", "05", "06", "07", "08", "pw01", "m286", "m287");
    }




    /**
     * Get stored value
     * @return string
     */
    public function getValue(){
        $result = $this->getSessionValue();
        if (strlen($result)<=0){
            //session is empty. So try now the cookie value
            $result = $this->getCookieValue();
        }
        return $result;
    }

    /**
     * Store value
     * @param $value
     */
    public function setValue($value){
        $this->setSessionValue($value);
        $this->setCookieValue($value);
    }

    public function setCookieValue($value){
        $this->cookieIO->setCookie(self::ENTITY_ID, $value);
    }

    public function setSessionValue($value){
        $this->sess->set(self::ENTITY_ID, $value);
    }

    public function getCookieValue(){
        $value = $this->cookieIO->getCookie(self::ENTITY_ID);
        if ($value == CookieIO::INVALID) {
            return Konstanten::LEER_STRING;
        }
        return $value;
    }

    public function getSessionValue(){
        return $this->sess->get(self::ENTITY_ID);
    }


}
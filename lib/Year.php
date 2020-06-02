<?php
require_once(__DIR__ . '/CookieIO.php');
require_once(__DIR__ . '/SessionIO.php');

/**
 * Created by PhpStorm.
 * User: dgar
 * Date: 05.07.17
 * Time: 12:06
 */
class Year
{

    private $cookieIO = null;
    private $sess = null;
    const ENTITY_ID = "year";
    /**
     * Semester constructor.
     */
    public function __construct()
    {
        $this->cookieIO = new CookieIO();
        $this->sess = new SessionIO();
    }


    /*
     * Settings for the actual year (Jahrgang)
     * First parameter is teacher: lp01=mael, lp02=gada
     * 2nd parameter ist the semester (BIVO 11) or the module (BIVO 19)
     */
    public $settings=array(
        2016 => array("lp02","05"),
        2017 => array("lp02","06"),
        2018 => array("lp01","04"),
        2019 => array("lp02","m288"),
        2020 => array("lp02","m286")
    );

    public function getCurrentSemester($year){
        return $this->settings[$year][1];
    }
    public function getCurrentTeacher($year){
        return $this->settings[$year][0];
    }

    public function getAllowedValues():array {
        return array(2016,2017,2018,2019,2020,9001);
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
<?php
/**
 * Created by PhpStorm.
 * User: dgar
 * Date: 8/6/2018
 * Time: 2:19 PM
 */

require_once(__DIR__ . '/CookieIO.php');
require_once(__DIR__ . '/SessionIO.php');
require_once(__DIR__ . '/Konstanten.php');
require_once(__DIR__ . '/SiteURL.php');

class Teacher {

    const ENTITY_ID = "lp";
    const SUBMIT_VAL = "Continue";
    const SUBMIT_ID = "contStep01";


    private $site = null;
    private $sessionIO = null;
    private $cookieIO = null;

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->site = new SiteURL();
        $this->sessionIO = new SessionIO();
        $this->cookieIO = new CookieIO();
    }



    /**
     * Return allowed values as an array
     * @return array
     */
    public function getAllowedValues():array {
        return array("lp01","lp02");
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




    public function getSessionValue(){
        return $this->sessionIO->get(self::ENTITY_ID);
    }
    public function setSessionValue($value){
        $this->sessionIO->set(self::ENTITY_ID, $value);
    }
    public function setCookieValue($value){
        $this->cookieIO->setCookie(self::ENTITY_ID, $value);
    }
    public function getCookieValue(){
        return $this->cookieIO->getCookie(self::ENTITY_ID);
    }


    /**
     * Process data from the input form
     */
    public function processForm()
    {
        if (isset($_POST[self::ENTITY_ID])) {
            $this->setSessionValue($_POST[self::ENTITY_ID]);
        }
    }

}


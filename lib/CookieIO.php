<?php
/**
 * Get and set cookies for a specific ict-Module, i.e. m183, m306
 * User: dgar
 * Created: 11.01.17
 * Updated: 11.01.17
 * History: initialized lib
 */
class CookieIO
{
    const INVALID = "";
    private $_time = -1;

    /**
     * @return int
     */
    public function getDuration()
    {
        if (intval($this->_time) == -1) {
            //1 Monat ist das Cookie gültig
            $this->_time = intval(60*60*24*30);
        }
        return $this->_time;
    }

    /**
     * @param int $time
     */
    public function setDuration($time)
    {
        $this->_time = $time;
    }

    public function setCookie($key, $value){
        if (isset($_COOKIE[$key])) {
            $this->clearCookie($key);
        }
        setcookie($key, $value, (string)(time() + $this->getDuration()), "/");
    }

    public function clearCookie($key){
        setcookie($key, null, null,"/");
    }

    public function getCookie($key){
        if (!isset($_COOKIE[$key])) {
            return CookieIO::INVALID;
        }
        return htmlspecialchars($_COOKIE[$key]);
    }

    public function isCookieValid($key){
        $result = false;
        if (isset($_COOKIE[$key])) {
            $result = true;
        }
        return $result;
    }
}
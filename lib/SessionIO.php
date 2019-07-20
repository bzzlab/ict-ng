<?php
//error_reporting( E_ALL & ~E_WARNING );
//ini_set('display_errors', 1);

/**
 * Setzt und liest die Session-Variablen
 * Created: dgar, 11.01.17
 * Updated: dgar, 11.01.17
 */
class SessionIO
{

    const INVALID = "";
    //define session timeout
    private $SESS_TIMEOUT=604800;

    /**
     * SessionIO constructor.
     */
    public function __construct()
    {
        $result = "";
        if (empty(session_id())) {
            $result = session_start();
        }

        if($result){
            //How do I expire a PHP session after 30 minutes?
            //Quelle: http://stackoverflow.com/questions/520237/how-do-i-expire-a-php-session-after-30-minutes
            if (!isset($_SESSION['CREATED'])) {
                $_SESSION['CREATED'] = time();
            } else if (time() - $_SESSION['CREATED'] > $this->SESS_TIMEOUT) {
                //set the session to two lessons duration = 1 Week in seconds (7*24*60*60 seconds)
                // change session ID for the current session and invalidate old session ID
                session_regenerate_id(true);
                // update creation time
                $_SESSION['CREATED'] = time();
            }
        }
    }


    public function set($key,$value){
        $_SESSION[$key]= $value;
    }

    public function clear($key){
        $_SESSION[$key]= SessionIO::INVALID;
    }

    public function get($key){
        if (!isset($_SESSION[$key])) {
            return SessionIO::INVALID;
        }
        return htmlspecialchars($_SESSION[$key]);
    }

    public function getObject($key){
        if (!isset($_SESSION[$key])) {
            return SessionIO::INVALID;
        }
        return $_SESSION[$key];
    }

    public function isValid($key){
        $result = false;
        if (isset($_SESSION[$key])) {
            $result = true;
        }
        return $result;
    }
}
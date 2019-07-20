<?php

class SiteURL
{
    const HOST = 'host';
    const PATH = 'path';
    const QUERY = 'query';

    public function getLocalDomain() {
//        return "mybzz.local"; //at the moment only one!
        return array("mybzz.local", "php.local");
    }


    /*
     * ‌‌$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        ‌http://php.local/projects/ict/index.php
        ‌‌parse_url($actual_link);
        ‌array (
          'scheme' => 'http',
          'host' => 'php.local',
          'path' => '/projects/ict/index.php',
     */

    /**
     * Ermittle die aktuelle URL der Seite
     * @return string
     */
    public function getCurrentUrl() {
        return ((empty($_SERVER['HTTPS'])) ? 'http://' : 'https://') .
            $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }


    /**
     * Gibt einen bestimmten Teil der URL zurück.
     *  $path = $pieces['path']; // enthält "/dir/dir/file.php"
     *  $query = $pieces['query']; // enthält "arg1=foo&arg2=bar"
     * @param $enumURL
     * @return mixed
     */
    public function getPartFromURL($enumURL) {
        $pieces = parse_url($this->getCurrentUrl());
        return $pieces[$enumURL];
    }

    public function getApplicationPath($script) {
        $url = $this->getCurrentUrl();
        if (strlen($script) > 0) {
            $url = str_replace($script, "", $url);
        }
        return $url;
    }

    /**
     * returns true if $nadel is a substring of $heuhaufen
     * @param $nadel
     * @param $heuhaufen
     * @return bool
     */
    public function contains($nadel, $heuhaufen) {
        return strpos($heuhaufen, $nadel) !== false;
    }

    /* Setzt die externen Ressourcen (css, js usw.) je nach Arbeitsweise
        offline -> von lokal
        online -> Remote von www.bzzlab.ch
    */
    public function getRemoteAssets() {
        $part = $this->getPartFromURL(SiteURL::HOST);
        foreach ($this->getLocalDomain() as $item) {
            if ($this->contains(strtolower($item), $part)) {
                return false;
            }
        }
        return true; //get Assests from bzzlab.ch
    }


    /*
    Zu Testzwecken:

    $actual_site =
        (isset($_SERVER['HTTPS']) ? "https" : "http").
        "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

    $escaped_url = htmlspecialchars( $actual_site, ENT_QUOTES, 'UTF-8' );
    echo '<a href="' . $escaped_url . '">' . $escaped_url . '</a>';

    */
}

?>
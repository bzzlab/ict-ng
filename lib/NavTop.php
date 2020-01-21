<?php
require_once(__DIR__ . '/NavTypeEnum.php');

class NavTop
{
    private $_label = "";
    private $_url = "";
    private $_navType = null;

    /**
     * @return string
     */
    public function getLink(): string
    {
        $result =
            sprintf("<a %s %s href=\"%s\">%s</a>",
                $this->getStyle(), $this->getTooltip(), $this->_url, $this->_label);
        return $result;
    }

    public function getStyle(): string
    {
        $result = sprintf("class=\"dropdown-item badge badge-light\"");
        //https://getbootstrap.com/docs/4.1/components/badge/
        if (strlen($this->_ddlExtra->getBadge())>0){
            $result = sprintf("class=\"dropdown-item %s\"",$this->_ddlExtra->getBadge());
        }
        return $result;
    }


    public function getTooltip(): string
    {
        $result = "";
        //https://getbootstrap.com/docs/4.1/components/tooltips/
        if (strlen($this->_ddlExtra->getTooltip())>0){
            $result = sprintf("data-toggle=\"tooltip\" data-placement=\"top\" 
                    title=\"%s\"",$this->_ddlExtra->getTooltip());
        }
        return $result;
    }


    /**
     * NavTop constructor.
     * @param string $_label
     * @param string $_url
     * @param NavTypeEnum $_navType
     */
    public function __construct(string $_label, string $_url,
                                NavTypeEnum $_navType)
    {
        $this->_label = $_label;
        $this->_url = $_url;
        $this->_navType = $_navType;
    }


}
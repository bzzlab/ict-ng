<?php


class NavTopExtra
{
    private $_badge = "";
    private $_tooltip = "";

    /**
     * @return null
     */
    public function getBadge():string
    {
        return $this->_badge;
    }

    /**
     * @param null $badge
     */
    public function setBadge($badge): void
    {
        $this->_badge = $badge;


    }

    /**
     * @return null
     */
    public function getTooltip()
    {
        return $this->_tooltip;
    }

    /**
     * @param null $tooltip
     */
    public function setTooltip($tooltip): void
    {
        $this->_tooltip = $tooltip;
    }
}
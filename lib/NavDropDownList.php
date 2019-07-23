<?php

require_once(__DIR__ . '/NavDropDown.php');


/**
 * Class NavDropDownList
 * https://medium.com/2dotstwice-connecting-the-dots/creating-strictly-typed-arrays-and-collections-in-php-37036718c921
 */
class NavDropDownList implements IteratorAggregate
{
    private $_linkList;
    private $_title;

    /**
     * NavDropDownCollection constructor.
     * @param string $_linkList
     * @param string $_title
     */
    //public function __construct(NavDropDown ...$_linkList)
    public function __construct(array $_linkList, $navTitle)
    {
        $this->_linkList = $_linkList;
        $this->_title = $navTitle;
    }


    private function getLinkList():string{
        $tmp = "";
        foreach($this->_linkList as $link){
            $tmp .= $link->getLink();
        }
        return $tmp;
    }


    public function write():string{
        return sprintf("<li class=\"nav-item dropdown\">
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\"
                   role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\"
                   aria-expanded=\"false\">%s</a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
                    %s
                </div>
            </li>", $this->_title, $this->getLinkList());
    }


    public function getIterator()
    {
        return new ArrayIterator($this->_linkList);
    }
}
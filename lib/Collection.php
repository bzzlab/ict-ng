<?php
/**
 * Quelle: https://www.sitepoint.com/collection-classes-in-php/
 * Date: 05.08.17
 */

class Collection
{
    private $items = array();

    /**
     * Add item
     * @param $obj
     * @param null $key
     * @throws Exception
     */
    public function addItem($obj, $key = null) {
        if ($key == null) {
            $this->items[] = $obj;
        }
        else {
            if (isset($this->items[$key])) {
                throw new Exception("Key $key already in use.");
            }
            else {
                $this->items[$key] = $obj;
            }
        }
    }

    public function deleteItem($key) {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        }
        else {
            throw new Exception("Invalid key $key.");
        }
    }

    public function getItem($key) {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        else {
            throw new Exception("Invalid key $key.");
        }
    }


    public function length() {
        return count($this->items);
    }

    public function keyExists($key) {
        return isset($this->items[$key]);
    }
}
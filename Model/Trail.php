<?php

namespace ICE\BreadcrumbsBundle\Model;

use ICE\BreadcrumbsBundle\Model\TrailInterface,
    ICE\BreadcrumbsBundle\Model\Crumb,
    Countable,
    Iterator;

/**
 * A Trail maintains all steps taken to get to the current page.
 */
class Trail implements TrailInterface, Iterator, Countable
{
    private $container = array();

    public function rewind() 
    {
        reset($this->container);
    }
    
    public function add($title, $url)
    {
        $this->container[$url] = new Crumb($title, $url);
        return $this;
    }
    
    public function get($url)
    {
        return (isset($this->container[$url])) ? $this->container[$url] : null;
    }
    
    public function remove($url)
    {
        unset($this->container[$url]);
        return $this;
    }

    public function removeAll()
    {
        unset($this->container);
        $this->container = array();
        return $this;
    }
    
    public function current() 
    {
        return current($this->container);
    }

    public function key() 
    {
        return key($this->container);
    }

    public function next() 
    {
        return next($this->container);
    }

    public function valid() 
    {
        return $this->current() !== false;
    }   

    public function count() 
    {
        return count($this->container);
    }
}
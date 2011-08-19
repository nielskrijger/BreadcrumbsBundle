<?php

namespace ICE\BreadcrumbsBundle\Model;

use ICE\BreadcrumbsBundle\Model\TrailInterface,
    ICE\BreadcrumbsBundle\Model\Crumb,
    Countable,
    Iterator;

class Trail implements TrailInterface, Iterator, Countable
{
    private $container = array();

    public function rewind() 
    {
        reset($this->container);
    }
    
    public function add($url, $title) 
    {
        $this->container[] = new Crumb($url, $title);
        return $this;
    }
    
    public function get($url)
    {
        $key = $this->getKey($url);
        return ($key === null) ? $key : $this->container[$key];
    }
    
    private function getKey($url)
    {
        $result = null;
        $i = 0;
        while ($result === null && $i < count($this->container))
        {
            if ($this->container[$i]->getUrl() == $url)
            {
                $result = $i;
            }
            $i++;
        }
        return $result;
    }
    
    public function remove($url)
    {
        $key = $this->getKey($url);
        unset($this->container[$key]);
        return $this;
    }

    public function removeAll()
    {
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
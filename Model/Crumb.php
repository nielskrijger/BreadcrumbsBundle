<?php

namespace ICE\BreadcrumbsBundle\Model;

use ICE\BreadcrumbsBundle\Model\CrumbInterface;

/**
 * A breadcrumb or simply crumb consists of an url and title. A crumb form a step
 * in the navigation path of a page.
 */
class Crumb implements CrumbInterface
{
    /**
     * Crumb title
     * 
     * @var string 
     */
    private $title;
    
    /**
     * Crumb url
     * 
     * @var string 
     */
    private $url;
    
    /**
     * Creates a breadcrumb. 
     *
     * @param string $title
     * @param string $url Optional
     */
    public function __construct($title, $url="")
    {
       $this->title = $title;
       $this->url = $url;
    }
    
    public function setTitle($title)
    {
        return $this->title = $title;
    }
    
    public function setUrl($url)
    {
        return $this->url = $url;
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * @return string Returns the title of this breadcrumb.
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}
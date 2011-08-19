<?php

namespace ICE\BreadcrumbsBundle\Model;

use ICE\BreadcrumbsBundle\Model\CrumbInterface;

/**
 * A breadcrumb or simply crumb consists of an url and title which form a step
 * in the navigation path of the current page.
 */
class Crumb implements CrumbInterface
{
    private
        $title,
        $url;
    
    /**
     * Creates a breadcrumb. The url can be left empty but you're advised 
     * not to. Rather implement empty breadcrumbs (for example for the last
     * crumb in the trail) in the view.
     *
     * @param string $title
     * @param string $url
     */
    public function __construct($title, $url)
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
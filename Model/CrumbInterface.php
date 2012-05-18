<?php

namespace ICE\BreadcrumbsBundle\Model;

interface CrumbInterface
{
    /**
     * @return string Returns the title of the breadcrumb.
     */
    public function getTitle();
    
    /**
     * @return string Returns the url of the breadcrumb.
     */
    public function getUrl();
    
    /**
     * Sets the title of the breadcrumb.
     * 
     * @return string $title
     */
    public function setTitle($title);
    
    /**
     * Sets the url of the breadcrumb.
     * 
     * @param string $url
     */
    public function setUrl($url);
}
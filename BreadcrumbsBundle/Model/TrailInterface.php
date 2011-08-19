<?php

namespace ICE\BreadcrumbsBundle\Model;

interface TrailInterface
{
    /**
     * Adds a crumb to the trail.
     * 
     * @param string $url
     * @param string $title
     */
    public function add($url, $text);
    
    /**
     * Removes a crumb from the trail identified by it's url.
     * 
     * @param string $url
     * @return TrailInterface
     */
    public function remove($url);

    /**
     * Removes all crumb from the trail.
     * 
     * @return TrailInterface
     */
    public function removeAll();
}
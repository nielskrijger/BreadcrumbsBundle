<?php

namespace ICE\BreadcrumbsBundle\Model;

interface TrailInterface
{
    /**
     * Adds a crumb to the trail and returns the TrailInterface instance.
     *
     * @param string $title
     * @param string $url
     * @return TrailInterface
     */
    public function add($title, $url);
    
    /**
     * Removes a crumb from the trail.
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
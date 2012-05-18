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
    
    /**
     * Returns the crumb by the crumb url or, when the crumb has no url, attempts
     * to find the crumb by its index. The first crumb without url will have
     * index 0, the second 1, etc.
     * 
     * @param $urlOrIndex 
     */
    public function get($urlOrIndex);
}
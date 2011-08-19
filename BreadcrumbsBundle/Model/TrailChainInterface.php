<?php

namespace ICE\BreadcrumbsBundle\Model;

interface TrailChainInterface
{
    /**
     * Adds a crumb to the trail and returns the Trail object.
     * 
     * @param string $url
     * @param string $title
     * @return Trail
     */
    public function with($url, $text);
}
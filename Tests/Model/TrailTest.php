<?php

namespace ICE\BreadcrumbsBundle\Tests\Model;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use ICE\BreadcrumbsBundle\Model\Trail;
use ICE\BreadcrumbsBundle\Model\CrumbInterface;
use ICE\BreadcrumbsBundle\Model\Crumb;

class TrailTest extends WebTestCase
{
    /**
     * @test
     */
    public function canCallConstructor() 
    {
        $trail = new Trail();
        $this->assertNotEquals($trail, null);
    }
    
    /**
     * @test
     */
    public function shouldAddAndRetrieveCrumb()
    {
        $trail = new Trail();
        $trail->add("title", "url");
        $crumb = $trail->get("url");
        $this->assertInstanceOf("ICE\BreadcrumbsBundle\Model\CrumbInterface", $crumb);
        $this->assertEquals("url", $crumb->getUrl());
        $this->assertEquals("title", $crumb->getTitle());
    }
    
    /**
     * @test
     */
    public function shouldAllowEmptyUrl()
    {
        $trail = new Trail();
        $trail->add("title");
        $crumb = $trail->get(0);
        $this->assertInstanceOf("ICE\BreadcrumbsBundle\Model\CrumbInterface", $crumb);
        $this->assertEquals("", $crumb->getUrl());
        $this->assertEquals("title", $crumb->getTitle());
    }
    
    /**
     * @test
     */
    public function shouldCountCrumbs()
    {
        $trail = new Trail();
        $trail->add("title1", "url1")->add("title2", "url2");
        $this->assertEquals(count($trail), 2);
    }
    
    /**
     * @test
     */
    public function shouldRemoveCrumbs()
    {
        $trail = new Trail();
        $trail->add("title1", "url1")->add("title2", "url2")->remove("url1");
        $this->assertEquals(1, count($trail));
    }

    /**
     * @test
     */
    public function shouldRemoveAllCrumbs()
    {
        $trail = new Trail();
        $trail->add("title1", "url1")->add("title2", "url2")->removeAll();
        $this->assertEquals(0, count($trail));
    }
    
    /**
     * @test
     */
    public function shouldIterateOverCrumbs()
    {
        $trail = new Trail();
        $trail->add("title1", "url1")->add("title2", "url2");
        $i = 1;
        foreach ($trail as $k => $v) 
        {
            $this->assertEquals("url".$i, $v->getUrl());
            $this->assertEquals("title".$i, $v->getTitle());
            $i++;
        }
    }
}

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
        $trail->add("url", "title");
        $crumb = $trail->get("url");
        $this->assertInstanceOf("ICE\BreadcrumbsBundle\Model\CrumbInterface", $crumb);
        $this->assertEquals("url", $crumb->getUrl());
        $this->assertEquals("title", $crumb->getTitle());
    }
    
    /**
     * @test
     */
    public function shouldAddCrumbsWithFluentInterface()
    {
        $trail = new Trail();
        $trail->with("url1", "title1")->with("url2", "title2");
        $this->assertEquals(2, count($trail));
    }
    
    /**
     * @test
     */
    public function shouldCountCrumbs()
    {
        $trail = new Trail();
        $trail->with("url1", "title1")->with("url2", "title2");
        $this->assertEquals(count($trail), 2);
    }
    
    /**
     * @test
     */
    public function shouldRemoveCrumbs()
    {
        $trail = new Trail();
        $trail->with("url1", "title1")->with("url2", "title2")->remove("url1");
        $this->assertEquals(1, count($trail));
    }

    /**
     * @test
     */
    public function shouldRemoveAllCrumbs()
    {
        $trail = new Trail();
        $trail->with("url1", "title1")->with("url2", "title2")->removeAll();
        $this->assertEquals(0, count($trail));
    }
    
    /**
     * @test
     */
    public function shouldIterateOverCrumbs()
    {
        $trail = new Trail();
        $trail->with("url1", "title1")->with("url2", "title2");
        $i = 1;
        foreach ($trail as $k => $v) 
        {
            $this->assertEquals("url".$i, $v->getUrl());
            $this->assertEquals("title".$i, $v->getTitle());
            $i++;
        }
    }
}

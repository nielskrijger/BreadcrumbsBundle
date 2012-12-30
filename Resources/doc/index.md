Getting Started With ICEBreadcrumbsBundle
==================================

## Installation

To install the ICEBreadcrumbsBundle you need to perform three steps:

1. Download ICEBreadcrumbsBundle
2. Configure the Autoloader
3. Enable the Bundle

### Step 1: Download ICEBreadcrumbsBundle

The destination of the ICEBreadcrumbsBundle files is the
`vendor/bundles/ICE/BreadcrumbsBundle` directory.

While there are several ways to do this, we explain it here using the `deps`
file.

Add the following lines in your `deps` file:

```
[ICEBreadcrumbsBundle]
    git=git://github.com/nielskrijger/BreadcrumbsBundle.git
    target=bundles/ICE/BreadcrumbsBundle
```

Afterwards, run the vendors script to download the bundle:

``` bash
$ php bin/vendors install
```

### Step 2: Configure the Autoloader

Add the `ICE` namespace to your autoloader:

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...
    'ICE' => __DIR__.'/../vendor/bundles',
));
```

### Step 3: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new ICE\BreadcrumbsBundle\ICEBreadcrumbsBundle(),
    );
}
```

## Simple usage

The breadcrumbs trail is available as a service.
You can access it in your controller directly:

``` php
<?php
// MyBundle/Controller/MyController.php

public function yourAction()
{
    $this->get("breadcrumbs")
        ->add("Home", $this->get("router")->generate("index"))
        ->add("Mypage", $this->get("router")->generate("mypage"));
}
```

You can split the steps to create crumbs for each separate action:

``` php
<?php
// MyBundle/Controller/MyController.php

public function firstActionTrail()
{
    return $this->get("breadcrumbs")->add("Home", $this->get("router")->generate("index"));
}

public function secondActionTrail()
{
    return $this->firstActionTrail()->add("Mypage", $this->get("router")->generate("mypage"));
}
```

## Rendering breadcrumbs in twig

To render the breadcrumbs in a twig template do the following:

```
{{ breadcrumbs() }}
```

## Advanced usage

If you need more reusability consider creating a breadcrumbs trail builder. For example, you could create something like this:

``` php
<?php

namespace MY\NewsBundle\Breadcrumbs;

use ICE\BreadcrumbsBundle\Model\TrailInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class NewsBreadcrumbsBuilder
{
    protected $trail;
    protected $newsItem;
    protected $isCreating;
    protected $isEditing;
    protected $router;

    public function __construct(TrailInterface $trail, UrlGeneratorInterface $router)
    {
        $this->trail = $trail;
        $this->router = $router;
        $this->isEditing = false;
        $this->isCreating = false;
        $this->newItem = null;
    }

    public function newsItem($newsItem)
    {
        $this->newsItem = $newsItem;
        return $this;
    }

    public function editing($isEditing = true)
    {
        $this->isEditing = $isEditing;
        return $this;
    }

    public function creating($isCreating = true)
    {
        $this->isCreating = $isCreating;
        return $this;
    }

    public function build()
    {
        $this->trail->add(
            "Latest news",
            $this->router->generate("get_news")
        );

        if (!empty($this->newsItem)) {
            $this->trail->add(
                $this->newsItem->getTitle(),
                $this->router->generate("get_newsitem", array(
                    'slug' => $this->newsItem->getSlug()
                ))
            );
        }

        if ($this->isCreating) {
            $this->trail->add(
                "New news item",
                $this->router->generate("new_newsitem")
            );
        }

        if ($this->isEditing) {
            $this->trail->add(
                "Edit news item",
                $this->router->generate("edit_newsitem", array(
                    'slug' => $this->newsItem->getSlug()
                ))
            );
        }

        return $this->trail;
    }
}
```

Next, register your breadcrumbs trail builder in the service container:

``` xml
<?xml version="1.0" ?>

<container xmlns="http://symfony.com/schema/dic/services"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">

    <services>
        <service id="news.breadcrumbs.builder" class="MY\NewsBundle\Breadcrumbs\NewsBreadcrumbsBuilder">
            <argument type="service" id="breadcrumbs" />
            <argument type="service" id="router" />
        </service>
    </services>

</container>
```

Finally, you can generate breadcrumb trails in your controller like this:

``` php
<?php
class NewsController
{
    public function getNewsitemAction($slug)
    {
    	// ... fetch $newsItem

        $this->getBreadcrumbsBuilder()->newsItem($newsItem)->build();
    }

    public function getEditNewsitem($slug)
    {
    	// ... fetch $newsItem

        $this->getBreadcrumbsBuilder()->newsItem($newsItem)->editing()->build();
    }

    public function getNewNewsitem()
    {
        $this->getBreadcrumbsBuilder()->creating()->build();
    }

    public function getNews()
    {
    	$this->getBreadcrumbsBuilder()->build();
    }

    private function getBreadcrumbsBuilder()
    {
        return $this->container->get('news.breadcrumbs.builder');
    }
}
```

Changing the template
=======================

There are two options how to customize the template used by this bundle:

Add config option to app/config.yml:

```
ice_breadcrumbs:
    template: AcmeDemoBundle::breadcrumbs.html.twig
```

ICEBreadcrumbsBundle will than use AcmeDemoBundle/Resources/breadcrumbs.html.twig instead of the default one.


Another option to change the breadcrumbs template is to copy the
`Resources/views/breadcrumbs.html.twig` file to
`app/Resources/ICEBreadcrumbsBundle/views`, and customize.

By default the last crumb in the trail is parsed with a class `last` allowing you to
style the final anchor. If you prefer to disable the last crumb anchor
altogether, you can create the following template:

``` html
<!-- app/Resources/ICEBreadcrumbsBundle/views/breadcrumbs.html.twig -->
{% block breadcrumbs %}
{% if trail|length() %}
<div id="breadcrumbs">
    {% for crumb in trail %}
        {% if not loop.last %}
			<a href="{{ crumb.url }}">{{ crumb.title }}</a> &gt;
        {% endif %}
		{% if loop.last %}
			{{ crumb.title }}
		{% endif %}
    {% endfor %}
</div>
{% endif %}
{% endblock %}
```
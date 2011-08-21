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

Usage
=====

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

You can split the steps to create crumbs for each separate page:

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

To render the breadcrumbs in your twig template do the following:

```
{{ breadcrumbs() }}
```

Changing the template
=======================

If you want to change the breadcrumbs template copy the
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
``` html
Getting Started With ICEBreadcrumbsBundle
==================================

## Installation

To install the ICEBreadcrumbsBundle you need to perform three steps:

1. Download ICEBreadcrumbsBundle
2. Configure the Autoloader
3. Enable the Bundle

### Step 1: Download ICEBreadcrumbsBundle

The destination of the ICEBreadcrumbsBundle files are the
`vendor/bundles/ICE/UserBundle` directory.

While there are several ways to do this, we explain it here using the `deps`
file.

Add the following lines in your `deps` file:

```
[ICEBreadcrumbsBundle]
    git=git://github.com/nielskrijger/ICEbreadcrumbsBundle.git
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
        ->with("Home", $this->get("router")->generate("index"))
        ->with("Mypage", $this->get("router")->generate("mypage"));
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
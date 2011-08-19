Getting Started With FOSUserBundle
==================================

The Symfony2 security component provides a flexible security framework that
allows you to load users from configuration, a database, or anywhere else
you can imagine. The FOSUserBundle builds on top of this to make it quick
and easy to store users in a database.

So, if you need to persist and fetch the users in your system to and from
a database, then you're in the right place.

## Installation

To install the ICEBreadcrumbsBundle you need to perform three steps:

1. Download FOSUserBundle
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

Add the `FOS` namespace to your autoloader:

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
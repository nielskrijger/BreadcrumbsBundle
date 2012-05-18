<?php

namespace ICE\BreadcrumbsBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface,
    ICE\BreadcrumbsBundle\Twig\Extension\BreadcrumbsTokenParser,
    Twig_Environment,
    Twig_Function_Method;

class BreadcrumbsExtension extends \Twig_Extension
{
    protected $breadcrumbs;
    protected $templating;
    protected $template;
    protected $environment;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     * @return void
     */
    public function __construct(ContainerInterface $container, $template)
    {
        $this->template = $template;
        $this->breadcrumbs = $container->get("breadcrumbs");
    }

    public function initRuntime(Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            'breadcrumbs' => new Twig_Function_Method($this, 'renderBreadcrumbs', array('is_safe' => array('html')))
        );
    }

    public function renderBreadcrumbs()
    {
        return $this->environment->render($this->template, array(
            'trail' => $this->breadcrumbs,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'breadcrumbs';
    }
}
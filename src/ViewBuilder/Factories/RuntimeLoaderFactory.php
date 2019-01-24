<?php declare(strict_types=1);

namespace FreshP\ContactFormApplication\ViewBuilder\Factories;

use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\FormRenderer;

class RuntimeLoaderFactory
{
    public static function create(\Twig_Environment $twig, string $formElementTheme): \Twig_FactoryRuntimeLoader
    {
        return new \Twig_FactoryRuntimeLoader([
            FormRenderer::class => function () use ($twig, $formElementTheme) {
                return new FormRenderer(
                    new TwigRendererEngine([$formElementTheme], $twig),
                    CsrfTokenFactory::create()
                );
            }
        ]);
    }
}

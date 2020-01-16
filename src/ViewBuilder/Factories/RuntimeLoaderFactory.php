<?php declare(strict_types = 1);

namespace FreshP\ContactFormApplication\ViewBuilder\Factories;

use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\FormRenderer;
use Twig\Environment;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

final class RuntimeLoaderFactory
{
    public static function create(Environment $twig, string $formElementTheme): FactoryRuntimeLoader
    {
        return new FactoryRuntimeLoader([
            FormRenderer::class => function () use ($twig, $formElementTheme) {
                return new FormRenderer(
                    new TwigRendererEngine([$formElementTheme], $twig),
                    CsrfTokenFactory::create()
                );
            },
        ]);
    }
}

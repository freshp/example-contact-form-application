<?php declare(strict_types=1);

namespace FreshP\ContactFormApplication\ViewBuilder\Factories;

use FreshP\ContactFormApplication\ViewBuilder\Configurations\ViewConfigurationInterface;

class TwigEnvironmentFactory
{
    public static function create(ViewConfigurationInterface $viewConfiguration): \Twig_Environment
    {
        $twig = new \Twig_Environment(
            new \Twig_Loader_Filesystem($viewConfiguration->getTemplateStoragePaths())
        );

        if ('' !== $viewConfiguration->getCachePath()) {
            $twig->setCache($viewConfiguration->getCachePath());
        }

        if (true === $viewConfiguration->isDebug()) {
            $twig->enableDebug();
        }

        return $twig;
    }
}

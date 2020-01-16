<?php declare(strict_types = 1);

namespace FreshP\ContactFormApplication\ViewBuilder\Factories;

use FreshP\ContactFormApplication\ViewBuilder\Configurations\ViewConfigurationInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class TwigEnvironmentFactory
{
    public static function create(ViewConfigurationInterface $viewConfiguration): Environment
    {
        $twig = new Environment(
            new FilesystemLoader($viewConfiguration->getTemplateStoragePaths())
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

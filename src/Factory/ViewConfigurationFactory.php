<?php declare(strict_types = 1);

namespace FreshP\ContactFormApplication\Factory;

use FreshP\ContactFormApplication\ViewBuilder\Configurations\ViewConfiguration;
use RuntimeException;

final class ViewConfigurationFactory
{
    public static function create(
        string $vendorDirectory,
        string $formDirectory,
        string $locale = 'de'
    ): ViewConfiguration {
        self::checkDirectories($vendorDirectory, $formDirectory);

        $viewConfiguration = new ViewConfiguration(
            [
                sprintf('%s/src/Resources/views', $formDirectory),
                sprintf('%s/symfony/twig-bridge/Resources/views/Form', $vendorDirectory),
            ],
            'bootstrap_3_horizontal_layout.html.twig',
            $locale
        );

        $viewConfiguration
            ->addTranslationResource(
                sprintf('%s/src/Resources/translations/labels.de.xlf', $formDirectory),
                'de',
                'messages'
            )
            ->addTranslationResource(
                sprintf('%s/src/Resources/translations/labels.en.xlf', $formDirectory),
                'en',
                'messages'
            );

        return $viewConfiguration;
    }

    private static function checkDirectories(string $vendorDirectory, string $formDirectory): void
    {
        if (false === is_dir($vendorDirectory)) {
            throw new RuntimeException('given vendor path could not be found ' . $vendorDirectory);
        }

        if (false === is_dir($formDirectory)) {
            throw new RuntimeException('given package path could not be found ' . $formDirectory);
        }
    }
}

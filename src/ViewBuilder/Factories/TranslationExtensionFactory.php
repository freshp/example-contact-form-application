<?php declare(strict_types = 1);

namespace FreshP\ContactFormApplication\ViewBuilder\Factories;

use FreshP\ContactFormApplication\ViewBuilder\Configurations\TranslationConfigurationInterface;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;

final class TranslationExtensionFactory
{
    public static function create(TranslationConfigurationInterface $translatorConfiguration): TranslationExtension
    {
        $translator = new Translator($translatorConfiguration->getLocale());
        $translator->addLoader('xlf', new XliffFileLoader());

        foreach ($translatorConfiguration->getTranslationResources() as $resource) {
            $translator->addResource(
                'xlf',
                $resource['path'],
                $resource['locale'],
                $resource['domain']
            );
        }

        return new TranslationExtension($translator);
    }
}

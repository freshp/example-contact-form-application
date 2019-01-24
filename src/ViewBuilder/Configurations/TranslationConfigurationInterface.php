<?php

namespace FreshP\ContactFormApplication\ViewBuilder\Configurations;

interface TranslationConfigurationInterface
{
    public function addTranslationResource(
        string $path,
        string $locale,
        string $domain = 'messages'
    ): TranslationConfigurationInterface;

    public function getLocale(): string;

    public function getTranslationResources(): array;
}

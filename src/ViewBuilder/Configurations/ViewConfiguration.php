<?php declare(strict_types=1);

namespace FreshP\ContactFormApplication\ViewBuilder\Configurations;

class ViewConfiguration implements ViewConfigurationInterface
{
    protected $templateStoragePaths = [];

    protected $formElementsTheme = '';

    protected $locale = '';

    protected $translationResources = [];

    protected $debug = false;

    protected $cachePath = '';

    public function __construct(
        array $templateStoragePaths,
        string $formElementsTheme,
        string $locale
    ) {
        $this->templateStoragePaths = $templateStoragePaths;
        $this->formElementsTheme = $formElementsTheme;
        $this->locale = $locale;
    }

    public function getTemplateStoragePaths(): array
    {
        return $this->templateStoragePaths;
    }

    public function setTemplateStoragePaths(array $templateStoragePaths): void
    {
        $this->templateStoragePaths = $templateStoragePaths;
    }

    public function getFormElementsTheme(): string
    {
        return $this->formElementsTheme;
    }

    public function setFormElementsTheme(string $formElementsTheme): void
    {
        $this->formElementsTheme = $formElementsTheme;
    }

    public function addTranslationResource(
        string $path,
        string $locale,
        string $domain = 'validators'
    ): TranslationConfigurationInterface {
        $this->translationResources[] = [
            'path' => $path,
            'locale' => $locale,
            'domain' => $domain
        ];

        return $this;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function getTranslationResources(): array
    {
        return $this->translationResources;
    }

    public function clearTranslationResources(): void
    {
        $this->translationResources = [];
    }

    public function isDebug(): bool
    {
        return $this->debug;
    }

    public function enableDebug(): void
    {
        $this->debug = true;
    }

    public function getCachePath(): string
    {
        return $this->cachePath;
    }

    public function setCachePath(string $cachePath): void
    {
        $this->cachePath = $cachePath;
    }
}

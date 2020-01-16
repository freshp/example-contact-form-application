<?php declare(strict_types = 1);

namespace FreshP\ContactFormApplication\ViewBuilder\Configurations;

interface ThemesConfigurationInterface
{
    public function getTemplateStoragePaths(): array;

    public function setTemplateStoragePaths(array $twigEnvironmentPaths): void;

    public function getFormElementsTheme(): string;

    public function setFormElementsTheme(string $defaultFormTheme): void;

    public function isDebug(): bool;

    public function enableDebug(): void;

    public function getCachePath(): string;

    public function setCachePath(string $cachePath): void;
}

<?php

namespace FreshP\ContactFormApplication\Tests\Unit\ViewBuilder\Configurations;

use FreshP\ContactFormApplication\ViewBuilder\Configurations\ViewConfiguration;
use PHPUnit\Framework\TestCase;

/**
 * @package MoveElevator\ViewBuilderPackage\Tests\Configurations
 */
class ViewConfigurationTest extends TestCase
{
    public function testInitializeAndGetConfiguration()
    {
        $viewConfiguration = new ViewConfiguration(
            [__DIR__],
            __DIR__ . '/../../../Fixtures/FormExample/views/index.html.twig',
            'en'
        );

        $this->assertEquals([__DIR__], $viewConfiguration->getTemplateStoragePaths());
        $this->assertEquals(
            __DIR__ . '/../../../Fixtures/FormExample/views/index.html.twig',
            $viewConfiguration->getFormElementsTheme()
        );
        $this->assertEquals('en', $viewConfiguration->getLocale());

        $this->assertFalse($viewConfiguration->isDebug());
        $viewConfiguration->enableDebug();
        $this->assertTrue($viewConfiguration->isDebug());

        $this->assertEmpty($viewConfiguration->getCachePath());
        $cachePath = __DIR__ . '/../../example/';
        $viewConfiguration->setCachePath($cachePath);
        $this->assertEquals($cachePath, $viewConfiguration->getCachePath());
    }

    public function testOverwriteAndGetConfiguration()
    {
        $viewConfiguration = new ViewConfiguration(
            [__DIR__],
            __DIR__ . '/../../../Fixtures/FormExample/views/index.html.twig',
            'en'
        );

        $viewConfiguration->setFormElementsTheme('overwrite.index.html.twig');
        $this->assertEquals('overwrite.index.html.twig', $viewConfiguration->getFormElementsTheme());

        $viewConfiguration->setTemplateStoragePaths([]);
        $this->assertEquals([], $viewConfiguration->getTemplateStoragePaths());
    }

    public function testAddAndGetTranslationResource()
    {
        $viewConfiguration = new ViewConfiguration(
            [__DIR__],
            __DIR__ . '/../../../Fixtures/FormExample/views/index.html.twig',
            'en'
        );

        $viewConfiguration
            ->addTranslationResource('translation.path.xlf', 'de', 'translationdomain')
            ->addTranslationResource('translation.validation.path.xlf', 'de');

        $resources = $viewConfiguration->getTranslationResources();

        $this->assertEquals(
            [
                [
                    'path' => 'translation.path.xlf',
                    'locale' => 'de',
                    'domain' => 'translationdomain'
                ],
                [
                    'path' => 'translation.validation.path.xlf',
                    'locale' => 'de',
                    'domain' => 'validators'
                ]
            ],
            $resources
        );

        $viewConfiguration->clearTranslationResources();

        $this->assertEmpty($viewConfiguration->getTranslationResources());
    }
}

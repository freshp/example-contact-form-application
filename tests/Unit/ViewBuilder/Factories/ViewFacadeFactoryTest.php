<?php

namespace FreshP\ContactFormApplication\Tests\Unit\ViewBuilder\Factories;

use FreshP\ContactFormApplication\ViewBuilder\Configurations\ViewConfiguration;
use FreshP\ContactFormApplication\ViewBuilder\Facades\ViewFacade;
use FreshP\ContactFormApplication\ViewBuilder\Factories\ViewFacadeFactory;
use PHPUnit\Framework\TestCase;

/**
 * @package MoveElevator\ViewBuilderPackage\Factories
 */
class ViewFacadeFactoryTest extends TestCase
{
    public function setUp()
    {
        if (defined('DEFAULT_FORM_THEME') === false) {
            define('DEFAULT_FORM_THEME', 'form_div_layout.html.twig');
            define('VENDOR_DIR', realpath(__DIR__ . '/../../vendor'));
            define('VENDOR_FORM_DIR', VENDOR_DIR . '/symfony/form');
            define('VENDOR_VALIDATOR_DIR', VENDOR_DIR . '/symfony/validator');
            define('VENDOR_TWIG_BRIDGE_DIR', VENDOR_DIR . '/symfony/twig-bridge');
            define('VIEWS_DIR', realpath(__DIR__ . '/../../examples/views'));
        }
    }

    public function testCreateViewFacade()
    {
        $viewConfiguration = new ViewConfiguration(
            [
                VIEWS_DIR,
                VENDOR_TWIG_BRIDGE_DIR . '/Resources/views/Form',
            ],
            DEFAULT_FORM_THEME,
            'en'
        );

        $viewConfiguration
            ->addTranslationResource(
                VENDOR_FORM_DIR . '/Resources/translations/validators.en.xlf',
                'en',
                'validators'
            )
            ->addTranslationResource(
                VENDOR_VALIDATOR_DIR . '/Resources/translations/validators.en.xlf',
                'en',
                'validators'
            );

        $viewFacade = ViewFacadeFactory::create($viewConfiguration);

        $this->assertInstanceOf(ViewFacade::class, $viewFacade);
    }

    public function testCreateViewFacadeWithDifferentSettings()
    {
        $viewConfiguration = new ViewConfiguration(
            [
                VIEWS_DIR,
                VENDOR_TWIG_BRIDGE_DIR . '/Resources/views/Form',
            ],
            DEFAULT_FORM_THEME,
            'en'
        );

        $viewConfiguration->addTranslationResource(
            VENDOR_FORM_DIR . '/Resources/translations/validators.en.xlf',
            'en',
            'validators'
        );
        $cachePath = __DIR__ . '/../../../Fixtures/FormExample/';
        $viewConfiguration->setCachePath($cachePath);
        $viewConfiguration->enableDebug();

        $viewFacade = ViewFacadeFactory::create($viewConfiguration);

        $this->assertInstanceOf(ViewFacade::class, $viewFacade);
        $this->assertTrue($viewFacade->getView()->isDebug());
    }
}

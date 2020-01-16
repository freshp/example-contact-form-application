<?php

namespace FreshP\ContactFormApplication\Tests\Unit\ViewBuilder\Facades;

use FreshP\ContactFormApplication\ViewBuilder\Configurations\ViewConfiguration;
use FreshP\ContactFormApplication\ViewBuilder\Factories\ViewFacadeFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ViewFacadeTest extends TestCase
{
    public function setUp(): void
    {
        if (defined('DEFAULT_FORM_THEME') === false) {
            define('DEFAULT_FORM_THEME', 'form_div_layout.html.twig');
            define('VENDOR_DIR', realpath(__DIR__ . '/../../../../vendor'));
            define('VENDOR_FORM_DIR', VENDOR_DIR . '/symfony/form');
            define('VENDOR_VALIDATOR_DIR', VENDOR_DIR . '/symfony/validator');
            define('VENDOR_TWIG_BRIDGE_DIR', VENDOR_DIR . '/symfony/twig-bridge');
            define('VIEWS_DIR', realpath(__DIR__ . '/../../../Fixtures/FormExample/views'));
        }

        /**
         * @TODO workaround for error message:
         * Cannot send session cookie - headers already sent by
         * (output started at /usr/local/phpStormSettings/vendor/phpunit/phpunit/src/Util/Printer.php:134)
         */
        @session_start();
    }

    public function testCreateFacadeAndRenderView(): void
    {
        $viewConfiguration = new ViewConfiguration(
            [
                VIEWS_DIR,
                VENDOR_TWIG_BRIDGE_DIR . '/Resources/views/Form',
            ],
            DEFAULT_FORM_THEME,
            'en'
        );

        $viewFacade = ViewFacadeFactory::create($viewConfiguration);

        $viewConfiguration
            ->addTranslationResource(VENDOR_FORM_DIR . '/Resources/translations/validators.en.xlf', 'en')
            ->addTranslationResource(VENDOR_VALIDATOR_DIR . '/Resources/translations/validators.en.xlf', 'en');

        // Create our first form!
        $form = $viewFacade->getFormFactory()->createBuilder()
            ->add('firstName', TextType::class, [
                'required' => true,
            ])
            ->add('name', TextType::class, [
                'required' => true,
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => ['m' => 'Male', 'f' => 'Female'],
            ])
            ->add('newsletter', CheckboxType::class)
            ->getForm();

        $url = 'https://www.test.de';
        $title = 'View Package';
        $viewFacade->setContent(
            [
                'url' => $url,
                'title' => $title,
                'form' => 'foo bar baz',
            ]
        );

        $viewFacade->appendContent(['form' => $form->createView()]);

        $result = $viewFacade->render('index.html.twig');

        $this->assertStringContainsString($title, $result);
        $this->assertStringContainsString($url, $result);
        $this->assertRegExp('~<form~i', $result);
    }
}

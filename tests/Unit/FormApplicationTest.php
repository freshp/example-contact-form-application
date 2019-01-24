<?php

namespace FreshP\ContactFormApplication\Tests\Unit;

use FreshP\ContactFormApplication\Factory\ViewConfigurationFactory;
use FreshP\ContactFormApplication\FormApplication;
use FreshP\ContactFormApplication\Model\ContactFormModel;
use FreshP\ContactFormApplication\Statics\AppStatics;
use FreshP\ContactFormApplication\Tests\Fixtures\Model\ContactFormModelTrait;
use FreshP\ContactFormApplication\ViewBuilder\Factories\ViewFacadeFactory;
use PHPUnit\Framework\TestCase;

class FormApplicationTest extends TestCase
{
    use ContactFormModelTrait;

    public function testExecuteFormSuccessful()
    {
        $viewConfiguration = ViewConfigurationFactory::create(
            realpath(__DIR__ . '/../../vendor'),
            __DIR__ . '/../..'
        );

        $viewFacade = ViewFacadeFactory::create($viewConfiguration);
        $formApplication = new FormApplication($viewFacade);
        $formApplication->validate();
        $htmlOutput = $formApplication->generateHtml('proceed.php');

        $this->assertRegExp('~<form~i', $htmlOutput);

        $errors = $formApplication->validate();

        $formData = [
            AppStatics::CONTACT_FORM_NAME => $this->contactFormModelName,
            AppStatics::CONTACT_FORM_EMAIL => $this->contactFormModelEmail,
            AppStatics::CONTACT_FORM_MESSAGE => $this->contactFormModelMessage,
        ];

        $errors->getForm()->submit($formData);

        $errors = $formApplication->validate();
        $this->assertTrue($errors->count() === 0);

        $formModel = $formApplication->mapDataToObject();
        $this->assertInstanceOf(ContactFormModel::class, $formModel);
    }

    public function testExecuteMapWithoutSubmit()
    {
        $viewConfiguration = ViewConfigurationFactory::create(
            realpath(__DIR__ . '/../../vendor'),
            __DIR__ . '/../..'
        );

        $viewFacade = ViewFacadeFactory::create($viewConfiguration);
        $formApplication = new FormApplication($viewFacade);
        $formApplication->validate();
        $htmlOutput = $formApplication->generateHtml('proceed.php');

        $this->assertRegExp('~<form~i', $htmlOutput);
        $this->assertEmpty($formApplication->mapDataToObject());
    }

    /**
     * @dataProvider inCompleteFormData
     */
    public function testExecuteInCompleteForm($formData)
    {
        $viewConfiguration = ViewConfigurationFactory::create(
            realpath(__DIR__ . '/../../vendor'),
            __DIR__ . '/../..'
        );

        $viewFacade = ViewFacadeFactory::create($viewConfiguration);
        $formApplication = new FormApplication($viewFacade);
        $formApplication->validate();
        $htmlOutput = $formApplication->generateHtml('proceed.php');

        $this->assertRegExp('~<form~i', $htmlOutput);

        $errors = $formApplication->validate();
        $errors->getForm()->submit($formData);

        $errors = $formApplication->validate();
        $this->assertFalse($errors->count() === 0);
        $this->assertEmpty($formApplication->mapDataToObject());
    }

    public function inCompleteFormData()
    {
        return [
            [
                [
                    AppStatics::CONTACT_FORM_EMAIL => $this->contactFormModelEmail,
                    AppStatics::CONTACT_FORM_MESSAGE => $this->contactFormModelMessage,
                ],
            ],
            [
                [
                    AppStatics::CONTACT_FORM_NAME => $this->contactFormModelName,
                    AppStatics::CONTACT_FORM_MESSAGE => $this->contactFormModelMessage,
                ],
            ],
            [
                [
                    AppStatics::CONTACT_FORM_NAME => $this->contactFormModelName,
                    AppStatics::CONTACT_FORM_EMAIL => $this->contactFormModelEmail,
                ],
            ],
            [
                [
                    AppStatics::CONTACT_FORM_NAME => $this->contactFormModelName,
                ],
            ],
            [
                [
                    AppStatics::CONTACT_FORM_EMAIL => $this->contactFormModelEmail,
                ],
            ],
            [
                [
                    AppStatics::CONTACT_FORM_MESSAGE => $this->contactFormModelMessage,
                ],
            ],
            [[]],
        ];
    }
}

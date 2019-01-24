<?php

namespace BuBi\CancelReservationForm\Tests\Unit\FormType\Driver;

use FreshP\ContactFormApplication\FormType\ContactFormType;
use FreshP\ContactFormApplication\Statics\AppStatics;
use FreshP\ContactFormApplication\Tests\Fixtures\Model\ContactFormModelTrait;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Validator\Validation;

class ContactFormTypeTest extends TypeTestCase
{
    use ContactFormModelTrait;

    /**
     * @return array
     */
    protected function getExtensions()
    {
        return [
            new ValidatorExtension(Validation::createValidator()),
        ];
    }

    public function testSubmitValidData()
    {
        $model = $this->getContactFormModelObject();

        $formData = [
            AppStatics::CONTACT_FORM_NAME => $this->contactFormModelName,
            AppStatics::CONTACT_FORM_EMAIL => $this->contactFormModelEmail,
            AppStatics::CONTACT_FORM_MESSAGE => $this->contactFormModelMessage,
        ];

        $form = $this->factory->create(ContactFormType::class, $model);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($model, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}

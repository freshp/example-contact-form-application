<?php

namespace FreshP\ContactFormApplication\Tests\Unit\FormType\Driver;

use FreshP\ContactFormApplication\FormType\ContactFormType;
use FreshP\ContactFormApplication\Statics\AppStatics;
use FreshP\ContactFormApplication\Tests\Fixtures\Model\ContactFormModelFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

class ContactFormTypeTest extends TestCase
{
    protected ?FormBuilder $builder;
    protected ?MockObject $dispatcher;
    protected ?FormFactoryInterface $factory;

    public function testSubmitValidData(): void
    {
        $model = ContactFormModelFactory::create();

        $formData = [
            AppStatics::CONTACT_FORM_NAME => ContactFormModelFactory::$contactFormModelName,
            AppStatics::CONTACT_FORM_EMAIL => ContactFormModelFactory::$contactFormModelEmail,
            AppStatics::CONTACT_FORM_MESSAGE => ContactFormModelFactory::$contactFormModelMessage,
        ];

        $form = $this->factory->create(ContactFormType::class, $model);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($model, $form->getData());

        $children = $form->createView()->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->dispatcher = $this->getMockBuilder(EventDispatcherInterface::class)->getMock();
        $this->factory = Forms::createFormFactoryBuilder()->addExtensions($this->getExtensions())->getFormFactory();
        $this->builder = new FormBuilder(null, null, $this->dispatcher, $this->factory);
    }

    protected function getExtensions(): array
    {
        return [
            new ValidatorExtension(Validation::createValidator()),
        ];
    }
}

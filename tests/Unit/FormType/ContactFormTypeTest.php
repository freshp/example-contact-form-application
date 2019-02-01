<?php

namespace FreshP\ContactFormApplication\Tests\Unit\FormType\Driver;

use FreshP\ContactFormApplication\FormType\ContactFormType;
use FreshP\ContactFormApplication\Statics\AppStatics;
use FreshP\ContactFormApplication\Tests\Fixtures\Model\ContactFormModelTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

class ContactFormTypeTest extends TestCase
{
    use ContactFormModelTrait;

    /**
     * @var FormBuilder
     */
    protected $builder;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @var FormFactoryInterface
     */
    protected $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dispatcher = $this->getMockBuilder(EventDispatcherInterface::class)->getMock();
        $this->factory = Forms::createFormFactoryBuilder()->addExtensions($this->getExtensions())->getFormFactory();
        $this->builder = new FormBuilder(null, null, $this->dispatcher, $this->factory);
    }

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

        $children = $form->createView()->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}

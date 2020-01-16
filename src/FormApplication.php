<?php declare(strict_types = 1);

namespace FreshP\ContactFormApplication;

use FreshP\ContactFormApplication\FormType\ContactFormType;
use FreshP\ContactFormApplication\Model\ContactFormModel;
use FreshP\ContactFormApplication\ViewBuilder\Facades\ViewFacadeInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\Form\FormInterface;

final class FormApplication
{
    public const FORM_NAME = 'contact-form';
    private ViewFacadeInterface $view;
    private string $templateFileName = 'index.html.twig';
    private string $formType = ContactFormType::class;
    private FormInterface $form;

    public function __construct(ViewFacadeInterface $view)
    {
        $this->view = $view;
        $this->createForm();
    }

    private function createForm(): void
    {
        $this->form = $this->view
            ->getFormFactory()
            ->createNamedBuilder(self::FORM_NAME, $this->formType)
            ->getForm();
    }

    public function generateHtml(string $targetUrl): string
    {
        $this->view->setContent([
            'form' => $this->form->createView(),
            'targetUrl' => $targetUrl,
        ]);

        return $this->view->render($this->templateFileName);
    }

    public function validate(): FormErrorIterator
    {
        $this->form->handleRequest();
        if (false === $this->form->isSubmitted()) {
            $this->form->addError(new FormError('form was not send'));

            return new FormErrorIterator($this->form, []);
        }

        if (false === $this->form->isValid()) {
            return $this->form->getErrors(true);
        }

        return new FormErrorIterator($this->form, []);
    }

    public function mapDataToObject(): ?ContactFormModel
    {
        if ($this->form->isSubmitted()) {
            return $this->form->getData();
        }

        return null;
    }
}

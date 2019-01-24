<?php declare(strict_types=1);

namespace FreshP\ContactFormApplication\ViewBuilder\Facades;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormFactoryBuilderInterface;

class ViewFacade implements ViewFacadeInterface
{
    /**
     * @var FormFactoryBuilderInterface
     */
    private $formFactoryBuilder;

    /**
     * @var \Twig_Environment
     */
    private $view;

    /**
     * @var array
     */
    private $content;

    public function getFormFactory(): FormFactoryInterface
    {
        return $this->getFormFactoryBuilder()->getFormFactory();
    }

    public function setFormFactoryBuilder(FormFactoryBuilderInterface $formFactoryBuilder): void
    {
        $this->formFactoryBuilder = $formFactoryBuilder;
    }

    public function getFormFactoryBuilder(): FormFactoryBuilderInterface
    {
        return $this->formFactoryBuilder;
    }

    public function getView(): \Twig_Environment
    {
        return $this->view;
    }

    public function setView(\Twig_Environment $view): void
    {
        $this->view = $view;
    }

    public function setContent(array $content): void
    {
        $this->content = $content;
    }

    public function appendContent(array $content): void
    {
        $this->content = array_merge($this->content, $content);
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function render(string $templateName): string
    {
        return $this->getView()->render($templateName, $this->content);
    }
}

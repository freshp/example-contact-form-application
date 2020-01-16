<?php declare(strict_types = 1);

namespace FreshP\ContactFormApplication\ViewBuilder\Facades;

use Symfony\Component\Form\FormFactoryBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final class ViewFacade implements ViewFacadeInterface
{
    private FormFactoryBuilderInterface $formFactoryBuilder;
    private Environment $view;
    private array $content;

    public function getFormFactory(): FormFactoryInterface
    {
        return $this->getFormFactoryBuilder()->getFormFactory();
    }

    public function getFormFactoryBuilder(): FormFactoryBuilderInterface
    {
        return $this->formFactoryBuilder;
    }

    public function setFormFactoryBuilder(FormFactoryBuilderInterface $formFactoryBuilder): void
    {
        $this->formFactoryBuilder = $formFactoryBuilder;
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
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(string $templateName): string
    {
        return $this->getView()->render($templateName, $this->content);
    }

    public function getView(): Environment
    {
        return $this->view;
    }

    public function setView(Environment $view): void
    {
        $this->view = $view;
    }
}

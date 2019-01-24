<?php

namespace FreshP\ContactFormApplication\ViewBuilder\Facades;

use Symfony\Component\Form\FormFactoryInterface;

interface ViewFacadeInterface
{
    public function appendContent(array $array): void;

    public function setContent(array $array): void;

    public function render(string $path): string;

    public function getFormFactory(): FormFactoryInterface;
}

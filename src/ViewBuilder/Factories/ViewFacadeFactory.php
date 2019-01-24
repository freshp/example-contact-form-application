<?php declare(strict_types=1);

namespace FreshP\ContactFormApplication\ViewBuilder\Factories;

use FreshP\ContactFormApplication\ViewBuilder\Configurations\ViewConfigurationInterface;
use FreshP\ContactFormApplication\ViewBuilder\Facades\ViewFacade;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;

class ViewFacadeFactory
{
    public static function create(ViewConfigurationInterface $viewConfiguration): ViewFacade
    {
        $twig = TwigEnvironmentFactory::create($viewConfiguration);

        $twig->addRuntimeLoader(RuntimeLoaderFactory::create($twig, $viewConfiguration->getFormElementsTheme()));

        $twig->addExtension(new FormExtension());
        $twig->addExtension(TranslationExtensionFactory::create($viewConfiguration));

        $viewFacade = new ViewFacade();
        $viewFacade->setFormFactoryBuilder(
            Forms::createFormFactoryBuilder()->addExtension(new ValidatorExtension(Validation::createValidator()))
        );
        $viewFacade->setView($twig);

        return $viewFacade;
    }
}

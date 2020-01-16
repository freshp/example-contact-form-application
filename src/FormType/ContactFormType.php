<?php declare(strict_types = 1);

namespace FreshP\ContactFormApplication\FormType;

use FreshP\ContactFormApplication\Model\ContactFormModel;
use FreshP\ContactFormApplication\Statics\AppStatics;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

final class ContactFormType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->setDataMapper($this)
            ->add(
                AppStatics::CONTACT_FORM_NAME,
                TextType::class,
                [
                    'required' => true,
                    'trim' => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                AppStatics::CONTACT_FORM_EMAIL,
                EmailType::class,
                [
                    'required' => true,
                    'trim' => true,
                    'constraints' => [
                        new NotBlank(),
                        new Email(),
                    ],
                ]
            )
            ->add(
                AppStatics::CONTACT_FORM_MESSAGE,
                TextareaType::class,
                [
                    'required' => true,
                    'trim' => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactFormModel::class,
            'empty_data' => null,
        ]);
    }

    /**
     * @param mixed $data
     */
    public function mapDataToForms($data, iterable $forms)
    {
        if (false === $data instanceof ContactFormModel) {
            return;
        }
        $forms = iterator_to_array((function () use ($forms) {
            yield from $forms;
        })());
        $forms[AppStatics::CONTACT_FORM_NAME]->setData($data->getName());
        $forms[AppStatics::CONTACT_FORM_EMAIL]->setData($data->getEmail());
        $forms[AppStatics::CONTACT_FORM_MESSAGE]->setData($data->getMessage());
    }

    /**
     * @param mixed $data
     */
    public function mapFormsToData(iterable $forms, &$data)
    {
        $forms = iterator_to_array((function () use ($forms) {
            yield from $forms;
        })());
        if (true === empty($forms[AppStatics::CONTACT_FORM_NAME]->getData())
            || true === empty($forms[AppStatics::CONTACT_FORM_EMAIL]->getData())
            || true === empty($forms[AppStatics::CONTACT_FORM_MESSAGE]->getData())
        ) {
            $data = null;

            return;
        }

        $data = new ContactFormModel(
            $forms[AppStatics::CONTACT_FORM_NAME]->getData(),
            $forms[AppStatics::CONTACT_FORM_EMAIL]->getData(),
            $forms[AppStatics::CONTACT_FORM_MESSAGE]->getData()
        );
    }
}

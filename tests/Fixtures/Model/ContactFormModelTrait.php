<?php declare(strict_types=1);

namespace FreshP\ContactFormApplication\Tests\Fixtures\Model;

use FreshP\ContactFormApplication\Model\ContactFormModel;

trait ContactFormModelTrait
{
    protected $contactFormModelName = 'tester';
    protected $contactFormModelEmail = 'test@test.de';
    protected $contactFormModelMessage = 'long Message';

    public function getContactFormModelObject(): ContactFormModel
    {
        return new ContactFormModel(
            $this->contactFormModelName,
            $this->contactFormModelEmail,
            $this->contactFormModelMessage
        );
    }
}

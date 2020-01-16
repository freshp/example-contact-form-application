<?php declare(strict_types = 1);

namespace FreshP\ContactFormApplication\Tests\Fixtures\Model;

use FreshP\ContactFormApplication\Model\ContactFormModel;

class ContactFormModelFactory
{
    public static string $contactFormModelName = 'tester';
    public static string $contactFormModelEmail = 'test@test.de';
    public static string $contactFormModelMessage = 'long Message';

    public static function create(): ContactFormModel
    {
        return new ContactFormModel(
            self::$contactFormModelName,
            self::$contactFormModelEmail,
            self::$contactFormModelMessage
        );
    }
}

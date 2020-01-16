<?php

namespace FreshP\ContactFormApplication\Tests\Unit\Model;

use FreshP\ContactFormApplication\Tests\Fixtures\Model\ContactFormModelFactory;
use PHPUnit\Framework\TestCase;

class ContactFormModelTest extends TestCase
{
    public function testInitAndGet()
    {
        $model = ContactFormModelFactory::create();

        $this->assertEquals(ContactFormModelFactory::$contactFormModelName, $model->getName());
        $this->assertEquals(ContactFormModelFactory::$contactFormModelEmail, $model->getEmail());
        $this->assertEquals(ContactFormModelFactory::$contactFormModelMessage, $model->getMessage());
    }
}

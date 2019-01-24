<?php

namespace FreshP\ContactFormApplication\Tests\Unit\Model;

use FreshP\ContactFormApplication\Tests\Fixtures\Model\ContactFormModelTrait;
use PHPUnit\Framework\TestCase;

class ContactFormModelTest extends TestCase
{
    use ContactFormModelTrait;

    public function testInitAndGet()
    {
        $model = $this->getContactFormModelObject();

        $this->assertEquals($this->contactFormModelName, $model->getName());
        $this->assertEquals($this->contactFormModelEmail, $model->getEmail());
        $this->assertEquals($this->contactFormModelMessage, $model->getMessage());
    }

}

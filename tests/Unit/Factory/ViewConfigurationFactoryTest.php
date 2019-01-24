<?php

namespace FreshP\ContactFormApplication\Tests\Unit\Factory;

use FreshP\ContactFormApplication\Factory\ViewConfigurationFactory;
use FreshP\ContactFormApplication\ViewBuilder\Configurations\ViewConfiguration;
use PHPUnit\Framework\TestCase;

class ViewConfigurationFactoryTest extends TestCase
{
    private $vendorDirectory;

    private $applicationDirectory;

    public function setUp()
    {
        $this->vendorDirectory = __DIR__ . '/../../../vendor';
        $this->applicationDirectory = __DIR__ . '/../../../';
    }

    public function testFactoryCreateSuccess()
    {
        $viewConfiguration = ViewConfigurationFactory::create(
            $this->vendorDirectory,
            $this->applicationDirectory
        );

        $this->assertInstanceOf(ViewConfiguration::class, $viewConfiguration);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testFactoryCreateThrowExceptionForNonExistingApplicationDirectory()
    {
        ViewConfigurationFactory::create(
            $this->vendorDirectory,
            $this->applicationDirectory . 'not-existing-directory'
        );
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testFactoryCreateThrowExceptionForNonExistingVendorDirectory()
    {
        ViewConfigurationFactory::create(
            sprintf('%ss', $this->vendorDirectory),
            $this->applicationDirectory
        );
    }
}

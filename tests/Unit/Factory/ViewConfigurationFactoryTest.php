<?php

namespace FreshP\ContactFormApplication\Tests\Unit\Factory;

use FreshP\ContactFormApplication\Factory\ViewConfigurationFactory;
use FreshP\ContactFormApplication\ViewBuilder\Configurations\ViewConfiguration;
use PHPUnit\Framework\TestCase;

class ViewConfigurationFactoryTest extends TestCase
{
    private $vendorDirectory;

    private $applicationDirectory;

    protected function setUp(): void
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

    public function testFactoryCreateThrowExceptionForNonExistingApplicationDirectory()
    {
        $this->expectException(\RuntimeException::class);
        ViewConfigurationFactory::create(
            $this->vendorDirectory,
            $this->applicationDirectory . 'not-existing-directory'
        );
    }

    public function testFactoryCreateThrowExceptionForNonExistingVendorDirectory()
    {
        $this->expectException(\RuntimeException::class);
        ViewConfigurationFactory::create(
            sprintf('%ss', $this->vendorDirectory),
            $this->applicationDirectory
        );
    }
}

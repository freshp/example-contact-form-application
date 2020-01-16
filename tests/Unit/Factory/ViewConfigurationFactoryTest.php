<?php

namespace FreshP\ContactFormApplication\Tests\Unit\Factory;

use FreshP\ContactFormApplication\Factory\ViewConfigurationFactory;
use FreshP\ContactFormApplication\ViewBuilder\Configurations\ViewConfiguration;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ViewConfigurationFactoryTest extends TestCase
{
    private string $vendorDirectory;
    private string $applicationDirectory;

    public function testFactoryCreateSuccess(): void
    {
        $viewConfiguration = ViewConfigurationFactory::create(
            $this->vendorDirectory,
            $this->applicationDirectory
        );

        $this->assertInstanceOf(ViewConfiguration::class, $viewConfiguration);
    }

    public function testFactoryCreateThrowExceptionForNonExistingApplicationDirectory(): void
    {
        $this->expectException(RuntimeException::class);
        ViewConfigurationFactory::create(
            $this->vendorDirectory,
            $this->applicationDirectory . 'not-existing-directory'
        );
    }

    public function testFactoryCreateThrowExceptionForNonExistingVendorDirectory(): void
    {
        $this->expectException(RuntimeException::class);
        ViewConfigurationFactory::create(
            sprintf('%ss', $this->vendorDirectory),
            $this->applicationDirectory
        );
    }

    protected function setUp(): void
    {
        $this->vendorDirectory = __DIR__ . '/../../../vendor';
        $this->applicationDirectory = __DIR__ . '/../../../';
    }
}

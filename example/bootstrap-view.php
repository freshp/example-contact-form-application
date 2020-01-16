<?php

use FreshP\ContactFormApplication\Factory\ViewConfigurationFactory;
use FreshP\ContactFormApplication\ViewBuilder\Factories\ViewFacadeFactory;

require __DIR__ . '/../vendor/autoload.php';

$language = 'de';
if (true === isset($_GET['L'])
    && 1 === (int)$_GET['L']
) {
    $language = 'en';
}

$viewConfiguration = ViewConfigurationFactory::create(
    dirname(__DIR__) . '/vendor',
    __DIR__ . '/..',
    $language
);

$viewFacade = ViewFacadeFactory::create($viewConfiguration);
$viewFacade->getView()->enableDebug();

echo '<link rel="stylesheet" href="dist/css/bootstrap.css"/>';
echo '<link rel="stylesheet" href="dist/css/styles.css"/>';
echo '<script src="dist/js/jquery.min.js"></script>';
echo '<script src="dist/js/bootstrap.min.js"></script>';

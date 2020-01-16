<?php

/**
 * things will be done by the carrier system for example TYPO3
 */

use FreshP\ContactFormApplication\FormApplication;

require __DIR__ . '/bootstrap-view.php';

$form = new FormApplication($viewFacade);

echo $form->generateHtml('proceed.php');

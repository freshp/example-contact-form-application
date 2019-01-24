<?php

/**
 * things will be done by the carrier system for example TYPO3
 */
require __DIR__ . '/bootstrap-view.php';

$form = new \FreshP\ContactFormApplication\FormApplication($viewFacade);

echo $form->generateHtml('proceed.php');

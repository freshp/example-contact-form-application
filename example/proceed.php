<?php

/**
 * things will be done by the carrier system for example TYPO3
 */
require __DIR__ . '/bootstrap-view.php';

$form = new \FreshP\ContactFormApplication\FormApplication($viewFacade);

$errors = $form->validate();
if ($errors->count() > 0) {
    echo $form->generateHtml('proceed.php');

    return;
}

$result = $form->mapDataToObject();

var_dump($result);

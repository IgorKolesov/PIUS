<?php

//include auto-load
set_include_path(__DIR__);
require 'vendor/autoload.php';

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

$validator = Validation::createValidator();
$violations = $validator->validate('Bernhard', [
    new Length(['min' => 10]),
    new NotBlank(),
]);

if (0 !== count($violations)) {
    // there are errors, now you can show them
    foreach ($violations as $violation) {
        echo $violation->getMessage().'<br>';
    }
}
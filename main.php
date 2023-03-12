<?php
namespace classes;

require 'vendor/autoload.php';
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;


$validator = Validation::createValidatorBuilder()
    ->addMethodMapping('loadValidatorMetadata')
    ->getValidator();

//creating users
$user1 = new User(1, "first_user@mail.ru", "pass123");
$user2 = new User(2, "senod_user@mail.ru", "pass456");

//time to show users, who was created after it
$afterThisTime = new \DateTime('now');

$user3 = new User(3, "third_user@mail.ru", "pass789");
$user4 = new User(4, "fourth_user@mail.ru", "pass135");
$user5 = new User(-5, "abra-kadabra", "q");

//adding users to array and check theirs data with validator
$users = [$user1, $user2, $user3, $user4, $user5];
foreach ($users as $u){
    $errors = $validator->validate($u);
    if (count($errors) > 0) {
        $errorsString = (string) $errors;
        echo "{$errorsString}\n";
    } else 
    {
        echo "User {$u->getId()} is valid!\n";
    }
}

//creating comments
$comment1 = new Comment($user1, "comment from user 1");
$comment2 = new Comment($user2, "comment from user 2");
$comment3 = new Comment($user3, "comment from user 3");
$comment4 = new Comment($user4, "comment from user 4");

//adding comments to array and watch info about them after genereted time
$comments = [$comment1, $comment2, $comment3, $comment4];
foreach($comments as $cm){
    if($cm->getUserCreationDate() > $afterThisTime){
        echo $cm->displayInfo();
    }
}

$userDateStr = readline("Format 'Y-m-d H:i:s': ");

//validation rules for date input
$validatorForDate = Validation::createValidator();
$violations = $validatorForDate->validate($userDateStr, [
    new Assert\DateTime(),
    new Assert\NotBlank(),
]);

//check inpt with validator
if (0 !== count($violations)){
    foreach ($violations as $violation){
        echo "{$violation->getMessage()}\n";
    }
} else {
    $userDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $userDateStr);

    //watch info about comments after user's time
    foreach($comments as $cm){
        if($cm->getUserCreationDate() > $userDateTime){
            echo $cm->displayInfo();
        }
    }
}
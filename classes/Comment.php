<?php
namespace classes;

class Comment {
    function __construct(protected User $user, protected string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function getUserCreationDate(): \DateTime
    {
        return $this->user->getCreationDate();
    }

    function displayInfo(): void
    {
        echo "User: {$this->user->getId()}; \nMessage: $this->message;\n";
    }
}



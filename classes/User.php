<?php
namespace classes;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class User {
    protected \DateTime $creationDate;

    function __construct(protected int $id, protected string $email, protected string $password)
    {
        $this->creationDate = new \DateTime('now');
    }

    function displayInfo(): void
    {
        echo "Id: $this->id; \nEmail: $this->email; \nPassword: $this->password; \nCreation date: {$this->creationDate->format('Y-m-d H:i:s')};\n";
    }

    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank());
        $metadata->addPropertyConstraint('id', new Assert\PositiveOrZero());

        $metadata->addPropertyConstraint('email', new Assert\NotBlank());
        $metadata->addPropertyConstraint(
            'email',
            new Assert\Email()
        );
        $metadata->addPropertyConstraint('password', new Assert\NotBlank());
        $metadata->addPropertyConstraint(
            'password',
            new Assert\Length(['min' => 3])
        );
    }
}



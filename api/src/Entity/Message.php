<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 20,
     *      minMessage = "La valeur du champs est trop courte (min: 1)",
     *      maxMessage = "La valeur du champs est trop longue (max: 20)",
     * )
     */
    private $pseudonym;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 500,
     *      minMessage = "La valeur du champs est trop courte (min : 1)",
     *      maxMessage = "La valeur du champs est trop longue (max : 500)"
     * )
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudonym(): ?string
    {
        return $this->pseudonym;
    }

    public function setPseudonym(string $pseudonym): void
    {
        $this->pseudonym = $pseudonym;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}

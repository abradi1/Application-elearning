<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $user_name;

    #[ORM\Column(type: 'integer')]
    private $user_rating;

    #[ORM\Column(type: 'string', length: 255)]
    private $user_review;

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getUserRating(): ?int
    {
        return $this->user_rating;
    }

    public function setUserRating(int $user_rating): self
    {
        $this->user_rating = $user_rating;

        return $this;
    }

    public function getUserReview(): ?string
    {
        return $this->user_review;
    }

    public function setUserReview(string $user_review): self
    {
        $this->user_review = $user_review;

        return $this;
    }

   

    
}

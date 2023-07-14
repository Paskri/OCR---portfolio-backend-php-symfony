<?php

namespace App\Entity;

use App\Repository\WorkRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: WorkRepository::class)]
class Work
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]//n
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]//n
    private ?string $projectTitle = null;

    #[ORM\Column(length: 255, nullable: true)]//n
    private ?string $logo = null;

    #[ORM\Column(type: 'json', nullable: true)]//n
    private array $logoSize = [0, 0];

    #[ORM\Column(length: 255, nullable: true)]//n
    private ?string $background = null;

    #[ORM\Column(length: 255, nullable: true)]//n
    private ?string $tags = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private array $desktop = [['title' => '','img' => '']];

    #[ORM\Column(type: 'json', nullable: true)]
    private array $mobile = [['title' => '','img' => '']];

    #[ORM\Column(length: 255, nullable: true)]//n
    private ?string $keywords = null;

    #[ORM\Column(length: 255, nullable: true)]//n
    private ?string $description = null;

    #[ORM\Column(type: 'json', nullable: true)]//n
    private array $skills = [''];

    #[ORM\Column(type: 'json', nullable: true)]//n
    private array $comments = [''];

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $demo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getProjectTitle(): ?string
    {
        return $this->projectTitle;
    }

    public function setProjectTitle(string $projectTitle): static
    {
        $this->projectTitle = $projectTitle;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getLogoSize(): array
    {
        return $this->logoSize;
    }

    public function setLogoSize(array $logoSize): static
    {
        $this->logoSize = $logoSize;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(string $background): static
    {
        $this->background = $background;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(string $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function getDesktop(): array
    {
        return $this->desktop;
    }

    public function setDesktop(?array $desktop): static
    {
        $this->desktop = $desktop;

        return $this;
    }

    public function getMobile(): array
    {
        return $this->mobile;
    }

    public function setMobile(?array $mobile): static
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): static
    {
        $this->keywords = $keywords;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function setSkills(array $skills): static
    {
        $this->skills = $skills;

        return $this;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function setComments(array $comments): static
    {
        $this->comments = $comments;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getDemo(): ?string
    {
        return $this->demo;
    }

    public function setDemo(?string $demo): static
    {
        $this->demo = $demo;

        return $this;
    }
}

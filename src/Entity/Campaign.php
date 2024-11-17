<?php

namespace App\Entity;

use App\Repository\CampaignRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CampaignRepository::class)]
class Campaign
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column]
    private DateTimeImmutable $beginAt;

    #[ORM\Column]
    private DateTimeImmutable $endAt;

    public function __construct(
        string $title,
        DateTimeImmutable $beginAt,
        DateTimeImmutable $endAt,
    ) {
        $this->title = $title;
        $this->beginAt = $beginAt;
        $this->endAt = $endAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBeginAt(): DateTimeImmutable
    {
        return $this->beginAt;
    }

    public function getEndAt(): DateTimeImmutable
    {
        return $this->endAt;
    }

    public function isActive(DateTimeInterface $now): bool
    {
        return $this->beginAt <= $now
            && $now < $this->endAt;
    }
}

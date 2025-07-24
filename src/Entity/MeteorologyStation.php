<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\MeteorologyStationRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeteorologyStationRepository::class)]
class MeteorologyStation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $stationId = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $wmoId = null;

    #[ORM\Column]
    private ?DateTimeImmutable $beginDate = null;

    #[ORM\Column]
    private ?DateTimeImmutable $endDate = null;

    #[ORM\Column]
    private ?int $latitude = null;

    #[ORM\Column]
    private ?int $longitude = null;

    #[ORM\Column(nullable: true)]
    private ?float $gauss1 = null;

    #[ORM\Column(nullable: true)]
    private ?float $gauss2 = null;

    #[ORM\Column]
    private ?float $geogr1 = null;

    #[ORM\Column]
    private ?float $geogr2 = null;

    #[ORM\Column]
    private ?float $elevation = null;

    #[ORM\Column(nullable: true)]
    private ?float $elevationPressure = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStationId(): ?string
    {
        return $this->stationId;
    }

    public function setStationId(string $stationId): static
    {
        $this->stationId = $stationId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getWmoId(): ?int
    {
        return $this->wmoId;
    }

    public function setWmoId(?int $wmoId): static
    {
        $this->wmoId = $wmoId;

        return $this;
    }

    public function getBeginDate(): ?DateTimeImmutable
    {
        return $this->beginDate;
    }

    public function setBeginDate(DateTimeImmutable $beginDate): static
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    public function getEndDate(): ?DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(DateTimeImmutable $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLatitude(): ?int
    {
        return $this->latitude;
    }

    public function setLatitude(int $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?int
    {
        return $this->longitude;
    }

    public function setLongitude(int $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getGauss1(): ?float
    {
        return $this->gauss1;
    }

    public function setGauss1(?float $gauss1): static
    {
        $this->gauss1 = $gauss1;

        return $this;
    }

    public function getGauss2(): ?float
    {
        return $this->gauss2;
    }

    public function setGauss2(?float $gauss2): static
    {
        $this->gauss2 = $gauss2;

        return $this;
    }

    public function getGeogr1(): ?float
    {
        return $this->geogr1;
    }

    public function setGeogr1(float $geogr1): static
    {
        $this->geogr1 = $geogr1;

        return $this;
    }

    public function getGeogr2(): ?float
    {
        return $this->geogr2;
    }

    public function setGeogr2(float $geogr2): static
    {
        $this->geogr2 = $geogr2;

        return $this;
    }

    public function getElevation(): ?float
    {
        return $this->elevation;
    }

    public function setElevation(float $elevation): static
    {
        $this->elevation = $elevation;

        return $this;
    }

    public function getElevationPressure(): ?float
    {
        return $this->elevationPressure;
    }

    public function setElevationPressure(?float $elevationPressure): static
    {
        $this->elevationPressure = $elevationPressure;

        return $this;
    }
}

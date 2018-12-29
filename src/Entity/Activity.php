<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityRepository")
 */
class Activity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $scale;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ActivityEntry", mappedBy="activity", orphanRemoval=true)
     */
    private $activityEntries;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtype;

    public function __construct()
    {
        $this->activityEntries = new ArrayCollection();
        try {
            $this->createdDate = new \DateTime();
        } catch (\Exception $e) {
            throw new \RuntimeException('Should not happen');
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getScale(): ?int
    {
        return $this->scale;
    }

    public function setScale(int $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return Collection|ActivityEntry[]
     */
    public function getActivityEntries(): Collection
    {
        return $this->activityEntries;
    }

    public function addActivityEntry(ActivityEntry $activityEntry): self
    {
        if (!$this->activityEntries->contains($activityEntry)) {
            $this->activityEntries[] = $activityEntry;
            $activityEntry->setActivity($this);
        }

        return $this;
    }

    public function removeActivityEntry(ActivityEntry $activityEntry): self
    {
        if ($this->activityEntries->contains($activityEntry)) {
            $this->activityEntries->removeElement($activityEntry);
            // set the owning side to null (unless already changed)
            if ($activityEntry->getActivity() === $this) {
                $activityEntry->setActivity(null);
            }
        }

        return $this;
    }

    public function getSubtype(): ?string
    {
        return $this->subtype;
    }

    public function setSubtype(?string $subtype): self
    {
        $this->subtype = $subtype;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name . ($this->subtype !== null ? ' - ' . $this->subtype : '');
    }

}

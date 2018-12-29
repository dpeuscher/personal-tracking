<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityEntryRepository")
 */
class ActivityEntry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $doneDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $extend;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activity", inversedBy="activityEntries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $activity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDoneDate(): ?\DateTimeInterface
    {
        return $this->doneDate;
    }

    public function setDoneDate(?\DateTimeInterface $doneDate): self
    {
        $this->doneDate = $doneDate;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getExtend(): ?int
    {
        return $this->extend;
    }

    public function setExtend(int $extend): self
    {
        $this->extend = $extend;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

}

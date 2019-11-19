<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $username;

    /**
     * @ORM\OneToOne(targetEntity="Seller", inversedBy="user")
     */
    private $seller;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TriggerCampaign", mappedBy="users")
     */
    private $triggerCampaigns;

    public function __construct()
    {
        $this->triggerCampaigns = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->getUsername();
    }

    /**
     * @return mixed
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param mixed $seller
     */
    public function setSeller($seller): void
    {
        $this->seller = $seller;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection|TriggerCampaign[]
     */
    public function getTriggerCampaigns(): Collection
    {
        return $this->triggerCampaigns;
    }

    public function addTriggerCampaign(TriggerCampaign $triggerCampaign): self
    {
        if (!$this->triggerCampaigns->contains($triggerCampaign)) {
            $this->triggerCampaigns[] = $triggerCampaign;
            $triggerCampaign->addUser($this);
        }

        return $this;
    }

    public function removeTriggerCampaign(TriggerCampaign $triggerCampaign): self
    {
        if ($this->triggerCampaigns->contains($triggerCampaign)) {
            $this->triggerCampaigns->removeElement($triggerCampaign);
            $triggerCampaign->removeUser($this);
        }

        return $this;
    }
}

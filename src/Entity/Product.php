<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
     * @ORM\ManyToOne(targetEntity="Seller", inversedBy="products")
     */
    private $seller;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TriggerCampaign", mappedBy="product")
     */
    private $triggerCampaigns;

    public function __construct()
    {
        $this->triggerCampaigns = new ArrayCollection();
    }

    public function __toString()
    {
        return (string)$this->getName();
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param mixed $categories
     */
    public function setCategories($categories): void
    {
        $this->categories = $categories;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $triggerCampaign->setProduct($this);
        }

        return $this;
    }

    public function removeTriggerCampaign(TriggerCampaign $triggerCampaign): self
    {
        if ($this->triggerCampaigns->contains($triggerCampaign)) {
            $this->triggerCampaigns->removeElement($triggerCampaign);
            // set the owning side to null (unless already changed)
            if ($triggerCampaign->getProduct() === $this) {
                $triggerCampaign->setProduct(null);
            }
        }

        return $this;
    }
}

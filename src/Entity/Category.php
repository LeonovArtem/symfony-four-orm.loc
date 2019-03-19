<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="categories")
     */
    private $products;

    public function __toString()
    {
        return (string)$this->getName();
    }

    /**
     * Add product
     *
     * @param Product $product
     *
     * @return Category
     */
    public function setProducts(Product $product)
    {
        // Эта строчка дает мне уверенность,
        // что не только категории назначен продукт, но продукту назначена категория
        $product->setCategories($this);
        $this->products = $product;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
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
}

<?php

namespace Neklesa\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorylink
 *
 * @ORM\Table(name="categorylink", indexes={@ORM\Index(name="categorylink_ibfk_1", columns={"category_id"}), @ORM\Index(name="product_id", columns={"product_id"})})
 * @ORM\Entity
 */
class Categorylink
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Neklesa\StoreBundle\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Neklesa\StoreBundle\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \Neklesa\StoreBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Neklesa\StoreBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param \Neklesa\StoreBundle\Entity\Category $category
     *
     * @return Categorylink
     */
    public function setCategory(\Neklesa\StoreBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Neklesa\StoreBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set product
     *
     * @param \Neklesa\StoreBundle\Entity\Product $product
     *
     * @return Categorylink
     */
    public function setProduct(\Neklesa\StoreBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Neklesa\StoreBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}

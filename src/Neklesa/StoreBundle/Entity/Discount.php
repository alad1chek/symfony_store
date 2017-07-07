<?php

namespace Neklesa\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discount
 *
 * @ORM\Table(name="discount", indexes={@ORM\Index(name="product_id", columns={"product_id"})})
 * @ORM\Entity
 */
class Discount
{
    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer", nullable=false)
     */
    private $count;

    /**
     * @var float
     *
     * @ORM\Column(name="coeff", type="float", precision=10, scale=0, nullable=false)
     */
    private $coeff;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * Set count
     *
     * @param integer $count
     *
     * @return Discount
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set coeff
     *
     * @param float $coeff
     *
     * @return Discount
     */
    public function setCoeff($coeff)
    {
        $this->coeff = $coeff;

        return $this;
    }

    /**
     * Get coeff
     *
     * @return float
     */
    public function getCoeff()
    {
        return $this->coeff;
    }

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
     * Set product
     *
     * @param \Neklesa\StoreBundle\Entity\Product $product
     *
     * @return Discount
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

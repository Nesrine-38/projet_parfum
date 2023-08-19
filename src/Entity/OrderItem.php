<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class OrderItem{
	#[Assert\NotBlank]
    private int $quantity;
    private float $itemPrice;

    private int $idOrder;
	private int $idProduct;
    private ?int $id;
    public function __construct(int $quantity,float $itemPrice,int $idOrder,int $idProduct,?int $id=null){
        $this->quantity = $quantity;
		$this->itemPrice = $itemPrice;
        $this->idOrder = $idOrder;
		$this->idProduct = $idProduct;
		$this->id = $id;
    }
      


	/**
	 * @return int
	 */
	public function getQuantity(): int {
		return $this->quantity;
	}
	
	/**
	 * @param int $quantity 
	 * @return self
	 */
	public function setQuantity(int $quantity): self {
		$this->quantity = $quantity;
		return $this;
	}
	
	/**
	 * @return float
	 */
	public function getItemPrice(): float {
		return $this->itemPrice;
	}
	
	/**
	 * @param float $itemPrice 
	 * @return self
	 */
	public function setItemPrice(float $itemPrice): self {
		$this->itemPrice = $itemPrice;
		return $this;
	}
	
	
	
	/**
	 * @return 
	 */
	public function getId(): ?int {
		return $this->id;
	}
	
	/**
	 * @param  $id 
	 * @return self
	 */
	public function setId(?int $id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getIdProduct(): int {
		return $this->idProduct;
	}
	
	/**
	 * @param int $idProduct 
	 * @return self
	 */
	public function setIdProduct(int $idProduct): self {
		$this->idProduct = $idProduct;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getIdOrder(): int {
		return $this->idOrder;
	}
	
	/**
	 * @param int $idOrder 
	 * @return self
	 */
	public function setIdOrder(int $idOrder): self {
		$this->idOrder = $idOrder;
		return $this;
	}
}
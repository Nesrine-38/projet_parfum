<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
class Options {
   
	#[Assert\NotBlank]
    private string $label;
    private float $price;
    private int $idProduct;
    private ?int $id;
    public function __construct(string $label,float $price,int $idProduct,?int $id = null) {
        $this->label = $label;
		$this->price = $price;
		$this->idProduct = $idProduct;
		$this->id = $id;
    }

	

	/**
	 * @return string
	 */
	public function getLabel(): string {
		return $this->label;
	}
	
	/**
	 * @param string $label 
	 * @return self
	 */
	public function setLabel(string $label): self {
		$this->label = $label;
		return $this;
	}
	
	/**
	 * @return float
	 */
	public function getPrice(): float {
		return $this->price;
	}
	
	/**
	 * @param float $price 
	 * @return self
	 */
	public function setPrice(float $price): self {
		$this->price = $price;
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
}
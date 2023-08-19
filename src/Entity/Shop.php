<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;


class Shop
{
	#[Assert\NotBlank]
	private string $name;
	#[Assert\NotBlank]
	private string $address;
	private ?int $id;

	public function __construct(string $name, string $address, ?int $id)
	{
		$this->name = $name;
		$this->address = $address;
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name 
	 * @return self
	 */
	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAddress(): string
	{
		return $this->address;
	}

	/**
	 * @param string $address 
	 * @return self
	 */
	public function setAddress(string $address): self
	{
		$this->address = $address;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * @param  $id 
	 * @return self
	 */
	public function setId(?int $id): self
	{
		$this->id = $id;
		return $this;
	}
}
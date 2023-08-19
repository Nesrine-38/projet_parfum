<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
class Orders
{
    private \DateTime $createdAt;
	#[Assert\NotBlank]
	private string $customerName;
    private ?int $id;
    public function __construct(\DateTime $createdAt, string $customerName, ?int $id)
    {
        $this->createdAt = $createdAt;
        $this->customerName = $customerName;
        $this->id = $id;
    }


	/**
	 * @return \DateTime
	 */
	public function getCreatedAt(): \DateTime {
		return $this->createdAt;
	}
	
	/**
	 * @param \DateTime $createdAt 
	 * @return self
	 */
	public function setCreatedAt(\DateTime $createdAt): self {
		$this->createdAt = $createdAt;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCustomerName(): string {
		return $this->customerName;
	}
	
	/**
	 * @param string $customerName 
	 * @return self
	 */
	public function setCustomerName(string $customerName): self {
		$this->customerName = $customerName;
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
}
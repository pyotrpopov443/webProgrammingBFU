<?php

class Message
{
	private $id;
	private $email;
	private $title;
	private $description;
	private $category;

	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id): Message
	{
		$this->id = $id;
		return $this;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function setEmail(string $email): Message
	{
		$this->email = $email;
		return $this;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle(string $title): Message
	{
		$this->title = $title;
		return $this;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function setDescription(string $description): Message
	{
		$this->description = $description;
		return $this;
	}

	public function getCategory(): string
	{
		return $this->category;
	}

	public function setCategory(string $category): Message
	{
		$this->category = $category;
		return $this;
	}

}

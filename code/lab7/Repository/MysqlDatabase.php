<?php

class MysqlDatabase
{
	/** @var MysqlDatabase */
	protected static $instance;
	protected $dbConnection;

	public static function getInstance()
	{
		if (is_null(static::$instance))
		{
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function getConnection(): mysqli
	{
		if (isset($this->dbConnection))
		{
			return $this->dbConnection;
		}
		$this->dbConnection = new mysqli(
			'localhost',
			'petr',
			'ilovephp',
			'webProgrammingBFU'
		);
		if (mysqli_connect_errno())
		{
			echo mysqli_connect_errno() . ": " . mysqli_connect_error();
		}
		return $this->dbConnection;
	}

	public function getCategories(): array
	{
		$result = $this->getConnection()->query("
			SELECT CATEGORY FROM webProgrammingBFU.ad
			GROUP BY CATEGORY;
		");

		$categories = [];
		foreach ($result as $row)
		{
			$categories[] = $row['CATEGORY'];
		}
		return $categories;
	}

	public function getMessages(): array
	{
		$result =  $this->getConnection()->query("
			SELECT EMAIL, TITLE, DESCRIPTION, CATEGORY FROM webProgrammingBFU.ad;
		");

		$messages = [];
		foreach ($result as $row)
		{
			$messages[] = $this->getMessage($row);
		}
		return $messages;
	}

	public function addMessage(Message $message): void
	{
		$preparedStatement = $this->getConnection()->prepare("
			INSERT INTO webProgrammingBFU.ad (EMAIL, CATEGORY, TITLE, DESCRIPTION)
			VALUES (?, ?, ?, ?);
		");

		$email = $message->getEmail();
		$category = $message->getCategory();
		$title = $message->getTitle();
		$description = $message->getDescription();

		$preparedStatement->bind_param('ssss', $email, $category, $title, $description);
		$preparedStatement->execute();
	}

	private function getMessage(array $messageData): Message
	{
		return (new Message())
			->setEmail($messageData['EMAIL'])
			->setCategory($messageData['CATEGORY'])
			->setTitle($messageData['TITLE'])
			->setDescription($messageData['DESCRIPTION']);
	}

}
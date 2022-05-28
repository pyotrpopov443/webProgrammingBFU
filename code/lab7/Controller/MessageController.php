<?php

class MessageController
{

	public function messageBoard(array $request)
	{
		$database = MysqlDatabase::getInstance();

		echo TemplateManager::renderTemplate('message-board.php', [
			'categories' => $database->getCategories(),
			'messages' => $database->getMessages()
		]);
	}

	public function addMessage(array $request)
	{
		$database = MysqlDatabase::getInstance();

		$message = (new Message())
			->setEmail($request['email'])
			->setCategory($request['message-category'])
			->setTitle($request['message-title'])
			->setDescription($request['message-text']);

		$database->addMessage($message);

		header('Location: /messages');
	}

}

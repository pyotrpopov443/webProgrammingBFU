<?php

include 'View/TemplateManager.php';
include 'Repository/MysqlDatabase.php';
include 'Controller/MessageController.php';
include 'Entity/Message.php';

$route = strtok($_SERVER["REQUEST_URI"], '?');

if ($route === '/messages')
{
	(new MessageController())->messageBoard($_REQUEST);
}

if ($route === '/addMessage')
{
	(new MessageController())->addMessage($_REQUEST);
}

<?php

$route = $_SERVER['REQUEST_URI'];

if ($route === '/addMessage')
{
	echo 'add message to db';
}

if ($route === '/')
{
	echo 'message board';
}

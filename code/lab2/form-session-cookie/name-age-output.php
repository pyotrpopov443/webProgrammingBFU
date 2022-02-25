<?php

if (!session_start())
{
	echo 'Перезагрузите страницу';
	return;
}

$userFirstName = $_SESSION['user-first-name'] ?? 'Не задано';
$userSecondName = $_SESSION['user-second-name'] ?? 'Не задана';
$userAge = $_SESSION['user-age'] ?? 'Не задан';

?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Check user profile</title>
</head>
<body>

<div class="user-info">
	Ваше имя: <?= $userFirstName?>
</div>
<div class="user-info">
	Ваша фамилия: <?= $userSecondName?>
</div>
<div class="user-info">
	Ваш возраст: <?= $userAge?>
</div>

</body>
</html>

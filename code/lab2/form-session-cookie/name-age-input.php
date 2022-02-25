<?php

if (!session_start())
{
	echo 'Перезагрузите страницу';
	return;
}

$userFirstName = $_SESSION['user-first-name'] ?? 'Не задано';
$userSecondName = $_SESSION['user-second-name'] ?? 'Не задана';
$userAge = $_SESSION['user-age'] ?? 'Не задан';

$_SESSION['user-first-name'] = $_POST['user-first-name'] ?? '';
$_SESSION['user-second-name'] = $_POST['user-second-name'] ?? '';
$_SESSION['user-age'] = $_POST['user-age'] ?? '';

?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Edit user profile</title>
</head>
<body>

<form action="name-age-input.php" method="post">
	<label for="user-first-name">Имя
		<input type="text" name="user-first-name" placeholder="Введите имя" value="<?= $userFirstName?>">
	</label>
	<label for="user-second-name">Фамилия
		<input type="text" name="user-second-name" placeholder="Введите фамилию" value="<?= $userSecondName?>">
	</label>
	<label for="user-age">Возраст
		<input type="text" name="user-age" placeholder="Введите возраст" value="<?= $userAge?>">
	</label>
	<input type="submit" value="Сохранить">
</form>

<a href="name-age-output.php">Проверить</a>

</body>
</html>

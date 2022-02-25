<?php

if (!session_start())
{
	echo 'Перезагрузите страницу';
	return;
}

$userData = $_SESSION['user-data'] ?? [];

$_SESSION['user-data'] = $_POST['user-data'] ?? [];

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

<form action="user-data-input.php" method="post">
	<label for="user-first-name">Имя
		<input type="text" name="user-data[Имя]" placeholder="Введите имя" value="<?= $userData['Имя'] ?? ''?>">
	</label>
	<label for="user-second-name">Фамилия
		<input type="text" name="user-data[Фамилия]" placeholder="Введите фамилию" value="<?= $userData['Фамилия'] ?? ''?>">
	</label>
	<label for="user-age">Возраст
		<input type="text" name="user-data[Возраст]" placeholder="Введите возраст" value="<?= $userData['Возраст'] ?? ''?>">
	</label>
	<input type="submit" value="Сохранить">
</form>

<a href="user-data-output.php">Проверить</a>

</body>
</html>

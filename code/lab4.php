<?php

$dbConnection = getConnection();

$messageBoardHeader = getHeader();
$messageBoardCategories = getCategories($dbConnection);
$messageBoardContent = getContent($dbConnection);

if (isset($_POST['message-category'], $_POST['message-title'], $_POST['message-text']) &&
	$_POST['message-category'] !== '' && $_POST['message-title'] !== '' && $_POST['message-text'] !== '')
{
	$message = ['plug@email', $_POST['message-category'], $_POST['message-title'], $_POST['message-text']];

	$query = "
		INSERT INTO webProgrammingBFU.ad (EMAIL, TITLE, DESCRIPTION, CATEGORY)
		VALUES (?, ?, ?, ?);
	";
	$preparedStatement = $dbConnection->prepare($query);
	$preparedStatement->execute($message);

	$messageBoardContent[] = $message;
}

function getConnection(): mysqli
{
	$dbConnection = new mysqli(
		'localhost',
		'petr',
		'ilovephp',
		'webProgrammingBFU'
	);
	if (mysqli_connect_errno()) {
		echo mysqli_connect_errno() . ": " . mysqli_connect_error();
	}
	return $dbConnection;
}

function getHeader(): array
{
	return ['Категория объявления', 'Заголовок объявления', 'Текст объявления'];
}

function getCategories(mysqli $dbConnection): array
{
	$query = "
		SELECT CATEGORY FROM webProgrammingBFU.ad
		GROUP BY CATEGORY;
	";
	$result = $dbConnection->query($query);

	$categories = [];
	foreach ($result as $row) {
		$categories[] = $row['CATEGORY'];
	}
	return $categories;
}

function getContent(mysqli $dbConnection): array
{
	$query = "
		SELECT EMAIL, TITLE, DESCRIPTION, CATEGORY FROM webProgrammingBFU.ad;
	";
	$result = $dbConnection->query($query);

	$messages = [];
	foreach ($result as $row) {
		$messages[] = [$row['EMAIL'], $row['TITLE'], $row['DESCRIPTION'], $row['CATEGORY']];
	}
	return $messages;
}

?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Доска объявлений</title>
</head>
<body>

<form action="lab3.php" method="post">
	<label for="email">Email
		<input type="email" name="email">
	</label>
	<label for="message-category">
		<select name="message-category">
			<?php foreach ($messageBoardCategories as $categoryName):?>
				<option value="<?= htmlspecialchars($categoryName)?>"><?= htmlspecialchars($categoryName)?></option>
			<?php endforeach;?>
		</select>
	</label>
	<label for="message-title">Заголовок
		<input type="text" name="message-title">
	</label>
	<label for="message-text">Текст
		<textarea name="message-text" cols="30" rows="10"></textarea>
	</label>
	<input type="submit" value="Добавить объявление">
</form>

<table>
	<caption>Объявления</caption>
	<tr>
		<?php foreach ($messageBoardHeader as $columnName):?>
			<th><?= htmlspecialchars($columnName)?></th>
		<?php endforeach;?>
	</tr>
	<?php foreach ($messageBoardContent as $row):?>
		<tr>
			<?php foreach ($row as $value):?>
				<td><?= htmlspecialchars($value)?></td>
			<?php endforeach;?>
		</tr>
	<?php endforeach;?>
</table>

</body>
</html>
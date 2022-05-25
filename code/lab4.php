<?php

$dbConnection = getConnection();

$messageBoardHeader = getHeader();
$messageBoardCategories = getCategories($dbConnection);
$messageBoardContent = getContent($dbConnection);

if (isset($_POST['message-category'], $_POST['message-title'], $_POST['message-text'], $_POST['email']) &&
	$_POST['message-category'] !== '' && $_POST['message-title'] !== '' && $_POST['message-text'] !== '' && $_POST['email'] !== '')
{
	$message = buildMessage([
		'EMAIL' => $_POST['email'],
		'CATEGORY' => $_POST['message-category'],
		'TITLE' => $_POST['message-title'],
		'DESCRIPTION' => $_POST['message-text']
	]);

	addMessage($dbConnection, $message);

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
	return ['Адрес электронной почты', 'Категория объявления', 'Заголовок объявления', 'Текст объявления'];
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
		$messages[] = buildMessage($row);
	}
	return $messages;
}

function addMessage(mysqli $dbConnection, array $message): void
{
	$query = "
		INSERT INTO webProgrammingBFU.ad (EMAIL, CATEGORY, TITLE, DESCRIPTION)
		VALUES (?, ?, ?, ?);
	";
	$preparedStatement = $dbConnection->prepare($query);
	$preparedStatement->bind_param('ssss', ...$message);
	$preparedStatement->execute();
}

function buildMessage(array $messageData): array
{
	return [
		$messageData['EMAIL'],
		$messageData['CATEGORY'],
		$messageData['TITLE'],
		$messageData['DESCRIPTION']
	];
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

<form action="lab4.php" method="post">
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
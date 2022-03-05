<?php

require_once '../vendor/autoload.php';

$client = new Google\Client();
$client->setApplicationName("Client_Library_Examples");
$client->setDeveloperKey("AIzaSyAibgRREZLohdewcd3W1t8vua2m5ZB8FHQ");

$service = new Google\Service\Sheets($client);
$spreadsheetId = '1eYDMg9MVygqfByQmzYuGNBrj0dEh4hk7tzLr3MB_SkU';

// if (isset($_POST['message-category'], $_POST['message-title'], $_POST['message-text']) &&
// 	$_POST['message-category'] !== '' && $_POST['message-title'] !== '' && $_POST['message-text'] !== '')
// {
// 	$service->spreadsheets_values->append($spreadsheetId, );
// }

$headerRange = 'message-board!B1:D1';
$response = $service->spreadsheets_values->get($spreadsheetId, $headerRange);
$messageBoardHeader = $response->getValues()[0];

$categoriesRange = 'message-board!A2:A';
$response = $service->spreadsheets_values->get($spreadsheetId, $categoriesRange);
$messageBoardCategories = $response->getValues();

$contentRange = 'message-board!B2:D';
$response = $service->spreadsheets_values->get($spreadsheetId, $contentRange);
$messageBoardContent = $response->getValues();

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
		<?php foreach ($messageBoardCategories as [$categoryName]):?>
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
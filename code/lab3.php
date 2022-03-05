<?php

require_once '../vendor/autoload.php';

$service = new Google\Service\Sheets(getClient());
$spreadsheetId = '1eYDMg9MVygqfByQmzYuGNBrj0dEh4hk7tzLr3MB_SkU';

$messageBoardHeader = getHeader($service, $spreadsheetId);
$messageBoardCategories = getCategories($service, $spreadsheetId);
$messageBoardContent = getContent($service, $spreadsheetId);

if (isset($_POST['message-category'], $_POST['message-title'], $_POST['message-text']) &&
	$_POST['message-category'] !== '' && $_POST['message-title'] !== '' && $_POST['message-text'] !== '')
{
	$message = [$_POST['message-category'], $_POST['message-title'], $_POST['message-text']];

	$i = count($messageBoardContent) + 1;
	$updateRange = "message-board!B$i:D$i";
	$body = new Google_Service_Sheets_ValueRange();
	$body->setValues([$message]);
	$params = ['valueInputOption' => "RAW"];
	$service->spreadsheets_values->update($spreadsheetId, $updateRange, $body, $params);

	$messageBoardContent[] = $message;
}

function getClient(): Google\Client
{
	$client = new Google\Client();
	$client->setApplicationName("Message Board");
	$client->setScopes(Google\Service\Sheets::SPREADSHEETS);
	$client->setDeveloperKey("AIzaSyCqz9Dtorg_cT4LYcim0qW6Jwn5ItSxIlo");
	putenv('GOOGLE_APPLICATION_CREDENTIALS=../credentials.json');
	$client->useApplicationDefaultCredentials();
	return $client;
}

function getHeader(Google\Service\Sheets $service, string $spreadsheetId): array
{
	$headerRange = 'message-board!B1:D1';
	$response = $service->spreadsheets_values->get($spreadsheetId, $headerRange);
	return $response->getValues()[0];
}

function getCategories(Google\Service\Sheets $service, string $spreadsheetId): array
{
	$categoriesRange = 'message-board!A2:A';
	$response = $service->spreadsheets_values->get($spreadsheetId, $categoriesRange);
	return $response->getValues();
}

function getContent(Google\Service\Sheets $service, string $spreadsheetId): array
{
	$contentRange = 'message-board!B2:D';
	$response = $service->spreadsheets_values->get($spreadsheetId, $contentRange);
	return $response->getValues();
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
<?php

if (isset($_POST['message-category'], $_POST['message-title'], $_POST['message-text']) &&
	$_POST['message-category'] !== '' && $_POST['message-title'] !== '' && $_POST['message-text'] !== '')
{
	file_put_contents("{$_POST['message-category']}/{$_POST['message-title']}", $_POST['message-text']);
}

$messageCategories = array_filter(glob('*'), 'is_dir');

$categories = [];
foreach ($messageCategories as $messageCategory)
{
	$categories[$messageCategory] = [];
	$fileNames = array_diff(scandir($messageCategory), array('..', '.'));
	foreach ($fileNames as $fileName)
	{
		$categories[$messageCategory][$fileName] = file_get_contents("$messageCategory/$fileName");
	}
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

<form action="message-board.php" method="post">
	<label for="email">Email
		<input type="email" name="email">
	</label>
	<label for="message-category">
		<select name="message-category">
			<?php foreach ($messageCategories as $messageCategory):?>
				<option value="<?= $messageCategory?>"><?= $messageCategory?></option>
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
		<th>Категория объявления</th>
		<th>Заголовок объявления</th>
		<th>Текст объявления</th>
	</tr>
	<?php foreach ($categories as $categoryName => $category):?>
		<?php foreach ($category as $messageTitle => $messageText):?>
			<tr>
				<td><?= $categoryName?></td>
				<td><?= $messageTitle?></td>
				<td><?= $messageText?></td>
			</tr>
		<?php endforeach;?>
	<?php endforeach;?>
</table>

</body>
</html>

<?php

/** @var $categories array */
/** @var $messages array<Message> */

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

<form action="addMessage" method="post">
	<label for="email">Email
		<input type="email" name="email">
	</label>
	<label for="message-category">
		<select name="message-category">
			<?php foreach ($categories as $categoryName):?>
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
		<th>Адрес электронной почты</th>
		<th>Категория объявления</th>
		<th>Заголовок объявления</th>
		<th>Текст объявления</th>
	</tr>
	<?php foreach ($messages as $message):?>
		<tr>
			<td><?= htmlspecialchars($message->getEmail())?></td>
			<td><?= htmlspecialchars($message->getCategory())?></td>
			<td><?= htmlspecialchars($message->getTitle())?></td>
			<td><?= htmlspecialchars($message->getDescription())?></td>
		</tr>
	<?php endforeach;?>
</table>

</body>
</html>
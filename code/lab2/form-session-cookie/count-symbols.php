<?php

$symbols = 0;
$words = 0;

$text = $_GET['text'] ?? '';
if (isset($text))
{
	$symbols = strlen($text);
	$words = str_word_count($text);
}

function in_range(int $value, int $min, int $max): bool
{
	return ($min <= $value) && ($value <= $max);
}

function format_word(string $word, int $count): string
{
	$tens = $count % 100;
	if (in_range($tens,5, 20))
	{
		return $word === 'слово' ? 'слов' : 'символов';
	}
	$digit = $tens % 10;
	if ($digit === 1)
	{
		return $word;
	}
	if (in_range($digit,2, 4))
	{
		return $word === 'слово' ? 'слова' : 'символа';
	}
	return $word === 'слово' ? 'слов' : 'символов';
}

?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Count symbols</title>
</head>
<body>

<form action="count-symbols.php">
	<label for="text">
		<textarea name="text" cols="30" rows="10"><?= $text?></textarea>
	</label>
	<input type="submit" value="Обновить количество слов и символов">
</form>
<div class="words-amount">
	<?= "В этом тексте $symbols ".format_word('символ', $symbols)." и $words ".format_word('слово', $words)?>
</div>

</body>
</html>

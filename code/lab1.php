<?php

function println($out = '')
{
	echo $out . '<br>';
}

/*=======================
1) Доступ по ссылке
=======================*/

/* Imagine a lot of code here */

$very_bad_unclear_name = "15 chicken wings";

//Write your code here:

$order = &$very_bad_unclear_name;
$order .= " and coca-cola";

//Don't change the line below

echo "<br>Your order is: {$very_bad_unclear_name}.";

/*=======================
2) Числа
=======================*/

println();

$int = 3;
println($int);

$float = 1.23;
println($float);

println(2+10);

$lastMonth = 1187.23;
$thisMonth = 1089.98;
println($lastMonth - $thisMonth);

/*=======================
11) Умножение и деление
=======================*/

$languagesCount = 4;
$months = 11;
$days = 16;
$daysPerLanguage = $months * $days;
println($daysPerLanguage);

/*=======================
12) Степень
=======================*/

println(8**2);

/*=======================
13) Операторы присвоения
=======================*/

$my_num = -2;
$answer = $my_num;
$answer += 2;
$answer *= 2;
$answer -= 2;
$answer /= 2;
$answer -= $my_num;
println($answer);

/*=======================
14) Математические функции
=======================*/

//Работа с %
$a = 10;
$b = 3;
println($a % $b);

if ($a % $b === 0)
{
	println('Делится');
}
else
{
	println('Не делится');
}

//Работа со степенью и корнем
$twoToTen = 2 ** 10;
$sqrt245 = sqrt(245);
$vec = [4, 2, 5, 19, 13, 0, 10];
$vecLength = 0;
foreach ($vec as $coordinate)
{
	$vecLength += $coordinate ** 2;
}
$vecLength = sqrt($vecLength);

//Работа с функциями округления
$sqrt379 = sqrt(379);
$round0Sqrt379 = round($sqrt379, 0);
$round1Sqrt379 = round($sqrt379, 1);
$round2Sqrt379 = round($sqrt379, 2);

$sqrt587 = sqrt(587);
$floorCeil = [
	'floor' => floor($sqrt587),
	'ceil' => ceil($sqrt587)
];

//Работа с min и max
$min = min(4, -2, 5, 19, -130, 0, 10);
$max = max(4, -2, 5, 19, -130, 0, 10);

//Работа с рандомом
try
{
	println(random_int(0, 100));
}
catch (Exception $e)
{
	println('Appropriate source of randomness did not found.');
}

//Работа с модулем
function modulusOfDifference($a, $b)
{
	return abs($a - $b);
}
$modulusOfDifference1 = modulusOfDifference($a, $b);
$modulusOfDifference2 = modulusOfDifference(5, 10);

$arr = [1, 2, -1, -2, 3, -3];
$newArr = [];
foreach ($arr as $value)
{
	$newArr[] = $value;
}

//Общее
function getDivisors(int $number): array
{
	$divisors = [1];
	for ($i = 2; $i <= $number/2; $i++)
	{
		if ($number % $i === 0)
		{
			$divisors[] = $i;
		}
	}
	$divisors[] = $number;
	return $divisors;
}

$number = 30000;
$divisors = getDivisors($number);

function getElementAddUpTo10Count(array $arr): int
{
	$sum = 0;
	foreach ($arr as $i => $iValue)
	{
		if ($sum > 10)
		{
			return $i;
		}
		$sum += $iValue;
	}
	return count($arr);
}

$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$result = getElementAddUpTo10Count($arr);

/*=======================
15) Функции
=======================*/

function printStringReturnNumber(): int
{
	println(' ');
	return 0;
}

$my_num = printStringReturnNumber();
println($my_num);

function increaseEnthusiasm(string $sad): string
{
	return "$sad!";
}

println(increaseEnthusiasm('Do labs'));

function repeatThreeTimes(string $str): string
{
	return str_repeat($str, 3);
}

println(repeatThreeTimes('casino'));
println(increaseEnthusiasm(repeatThreeTimes('Do labs')));

function cut(string $str, int $limit = 10) {}

function printArrayRecursive(array $arr, $i = 0): void
{
	if ($i >= count($arr))
	{
		return;
	}
	echo $arr[$i] . ' ';
	printArrayRecursive($arr, $i + 1);
}

printArrayRecursive($arr);
println();

function getDigitsSum(int $number): int
{
	$sum = 0;
	while ($number > 0)
	{
		$sum += $number % 10;
		$number /= 10;
	}
	return $sum;
}

$number = 12345;
$result = getDigitsSum($number);
while ($result >= 10)
{
	$result = getDigitsSum($result);
}
println($result);

/*=======================
17) Массивы
=======================*/

$infinity = 10;
$infiniteArray = [];
for ($i = 1; $i <= 10; $i++)
{
	$infiniteArray[] = "'" . str_repeat("x", $i) . "'";
}

function arrayFill(string $value, string $count): array
{
	return array_fill(0, $count, $value);
}

$sum = 0;
$array2d = [[1, 2, 3], [4, 5], [6]];
foreach ($array2d as $array1d)
{
	foreach ($array1d as $value)
	{
		$sum += $value;
	}
}

$array2d = [];
for ($i = 0; $i < 3; $i++)
{
	$array1d = [];
	for ($j = 1 + 3 * $i; $j <= 3 + 3 * $i; $j++)
	{
		$array1d[] = $j;
	}
	$array2d[] = $array1d;
}

$arr = [2, 5, 3, 9];
$result = 0;
foreach ($arr as $i => $value)
{
	if ($i >= count($arr) - 1)
	{
		break;
	}
	$result += $value * $arr[$i + 1];
}

$user = [
	'name' => 'Петр',
	'surname' => 'Попов',
	'patronymic' => 'Андреевич'
];
foreach ($user as $namePart)
{
	echo $namePart . ' ';
}
println();

$date = [
	'year' => date('Y'),
	'month' => date('m'),
	'day' => date('d'),
];
println("{$date['year']}-{$date['month']}-{$date['day']}");

$arr = ['a', 'b', 'c', 'd', 'e'];
$size = count($arr);
println($size);
println($arr[$size - 1]);
println($arr[$size - 2]);

/*=======================
18) Конструкция if else
=======================*/

function sumMoreThanTen(int $number1, int $number2): bool
{
	return $number1 + $number2 > 10;
}

function equals(int $number1, int $number2): bool
{
	return $number1 === $number2;
}

$test = 0;
?>

Long form:
<?php
if ($test === 0)
{
	echo 'верно';
}
?>

<br>

Short form:
<?= $test === 0 ? 'верно' : ''?>

<?php

println();

$age = 10;
if ($age < 10 || $age > 99)
{
	println('$age is less than 10 or greater than 99.');
}
else
{
	$sum = getDigitsSum($age);
	if ($sum <= 9)
	{
		println('Сумма цифр значения переменной $age однозначна.');
	}
	else
	{
		println('Сумма цифр значения переменной $age двузначна.');
	}
}

$arr = [1, 2, 3, 4, 5];
if (count($arr) === 3)
{
	println(array_sum($arr));
}

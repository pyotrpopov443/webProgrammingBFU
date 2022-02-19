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

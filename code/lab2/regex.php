<?php

/*=======================
Задание a.
=======================*/

$str = 'ahb acb aeb aeeb adcb axeb';

preg_match_all('/a\w{2}b/', $str, $matches);

/*=======================
Задание b.
=======================*/

$str = 'a1b2c3';

$str = preg_replace_callback(
	'/\d+/',
	static function($matches)
	{
		return $matches[0] ** 3;
	},
	$str
);

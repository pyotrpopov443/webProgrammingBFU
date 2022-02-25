<?php

/*=======================
Задание a.
=======================*/

$str = 'ahb acb aeb aeeb adcb axeb';

preg_match_all('/a\w{2}b/', $str, $matches);

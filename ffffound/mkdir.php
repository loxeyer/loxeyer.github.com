<?php

date_default_timezone_set("America/Los_Angeles");

$string = '1234567890abcdefghijklmnopqrstuvwxyz';

// 随机取两位
//echo $t1=$str[rand(0,35)].$str[rand(0,35)];


for($i=0;$i<strlen($string);$i++){
	for($j=0;$j<strlen($string);$j++){
		$first = substr($string,$i,1);
		$second = substr($string,$j,1);
		echo mkdirm('image/'.$first.$second);

		for($m=0;$m<strlen($string);$m++){
			for($n=0;$n<strlen($string);$n++){
				$third = substr($string,$m,1);
				$four = substr($string,$n,1);
				echo mkdirm('image/'.$first.$second.'/'.$third.$four);
			}
		}
	}
}


function mkdirm($path)
{
	if (!file_exists($path))
	{
		mkdirm(dirname($path));
		mkdir($path, 0777);
	}
}



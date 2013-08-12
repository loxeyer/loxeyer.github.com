<?php
date_default_timezone_set('Asia/Shanghai');
$db=mysql_connect('127.0.0.1','root','');
mysql_select_db('findpp');
mysql_query("SET NAMES 'UTF8'");
if(!$db)
	echo"connect error";

init();

function init()
{
	$list = file_get_contents("http://ffffound.com/");
	$list = preg_replace("/\s+/", " ", $list);
	preg_match_all('/(<td valign=\"top" width=\"520\">(.+?)\<\/td>)/',$list,$cutlist);


	$number_list = count($cutlist[2]);

	for($i=0;$i<$number_list;$i++){

		preg_match_all('/(href=\"(.+?)\"\>\<img)/',$cutlist[2][$i],$innerurl);

		$old_md5 = substr($innerurl[2][0], -40);

		$inner_content = file_get_contents($innerurl[2][0]);

		$inner_content = preg_replace("/\s+/", " ", $inner_content);

		// get header
		preg_match_all('/(Quoted from:\<\/span\>(.+?)<br><\/div>)/',$inner_content, $header);

		// get pic_real_url 
		preg_match_all('/(<div class=\"description\">(.+?)\<br>)/',$header[0][0],$pic_real_url);

		preg_match_all('/(src=\"(.+?)\" alt)/', $cutlist[2][$i], $pic_url);

		$md5 = md5($pic_real_url[2][0]);

		//******************about file start

		$first = substr($md5,0,2);
		$second = substr($md5,2,2);
		$filepath = "/data/web/findpp/image/".$first."/".$second;

		!is_dir($filepath)?mkdir($filepath):null;
		//获得随机的图片名，并加上后辍名
		$filename = $md5.'.'.substr($pic_url[2][0],-3,3);

		$file = $filepath.'/'.$filename;

		if(file_exists($file)){
			echo "\n".$file." was found";
			continue;
		}

		download($pic_url[2][0], $file);

		//****************** about file end

		// get image title
		preg_match_all('/(;\"\>(.+?)\<\/a>)/',$header[0][0],$title);

		// get the frompage 
		preg_match_all('/(href=\"(.+?)\" title)/',$header[0][0],$from_page);
		// get related content

		preg_match_all('/(<div class=\"related_to_item\">(.+?)<\/div>)/',$inner_content, $related);

		$number = count($related[2]);
		$relate_hash = '';
		for($j=0;$j<$number;$j++)
		{
			preg_match_all('/(\/image\/(.+?)\" onclick)/',$related[2][$j],$relate);
			$relate_hash .= $relate[2][0].",";
		}

		$query2="insert into image(id, title, old_md5, pic_url, pic_real_url, from_page, old_md5_related) values('".$md5."','".$title[2][0]."','".$old_md5."','".$pic_url[2][0]."','".$pic_real_url[2][0]."','".$from_page[2][0]."','".$relate_hash."')";
		$result2=mysql_query($query2);

		echo $i;

	}
}

function download($url, $file){

	//$string = '1234567890abcdefghijklmnopqrstuvwxyz';

	// 随机取两位
	//echo $t1=$str[rand(0,35)].$str[rand(0,35)];
	$ext = strrchr($url, '.');

	if ($ext != '.gif' && $ext != '.jpg') {
		return false;
	}

	//读取图片
	$img = fetch_urlpage_contents($url);
	//指定打开的文件
	$fp = @ fopen($file, 'a');
	//写入图片到指定的文本
	fwrite($fp, $img);
	fclose($fp);
	return $file;
}

function fetch_urlpage_contents($url){  
	$ch = curl_init();  
	curl_setopt ($ch, CURLOPT_URL, $url);  
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt ($ch, CURLOPT_TIMEOUT, 1000);  
	$file_contents = curl_exec($ch);  
	curl_close($ch);  
	return $file_contents;  
}


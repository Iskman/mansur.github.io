<?php

	header("Content-Type: text/html; charset=utf-8");
	
	$url = "rss.xml"; // Адрес до RSS-ленты
	$rss = simplexml_load_file($url);

	$name_channel = $rss->channel->title; // Имя ленты
	$link_channel = $rss->channel->link; // Ссылка на источник
	$description_channel = $rss->channel->description; // Описание ленты

	echo $description_channel; // Выводим описание
	echo "shit!";
?>
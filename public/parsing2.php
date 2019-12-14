<?php

	header("Content-Type: text/html; charset=utf-8");

	$url = "https://informburo.kz/xml/rss.xml"; // Адрес до RSS-ленты
	$rss = simplexml_load_file($url);

	foreach ($rss->channel->item as $items) {
		
		echo <<<HTML

			<h1>{$items->title}</h1>
			<p>{$items->description}</p>
			<a href="{$items->link}">Подробнее</a>

HTML;

	}
	
?>
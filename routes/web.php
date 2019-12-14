<?php
/*=============================================================================================================================================

	ТЕСТОВОЕ ЗАДАНИЕ ДЛЯ ПГУ 
	(Парсер новостей из RSS изданий на Laravel..)
	
	АВТОР: ИСКАКОВ МАНСУР
	ТЕЛЕФОН: 87477360201
	
	╔╗╔╗╔═══╗╔╗──╔╗──╔══╗
	║║║║║╔══╝║║──║║──║╔╗║
	║╚╝║║╚══╗║║──║║──║║║║
	║╔╗║║╔══╝║║──║║──║║║║
	║║║║║╚══╗║╚═╗║╚═╗║╚╝║
	╚╝╚╝╚═══╝╚══╝╚══╝╚══╝
	╔═══╗╔══╗╔╗╔╗
	║╔═╗║║╔═╝║║║║
	║╚═╝║║╚═╗║║║║
	║╔══╝╚═╗║║║║║
	║║───╔═╝║║╚╝║
	╚╝───╚══╝╚══╝

=============================================================================================================================================*/

Route::get('/', function () {

	include_once 'simple_html_dom.php'; // функции для упрощения парсинга

	$parsing = DB::table('parsing')->get();

	// эта часть кода для поочередного парсинга RSS лент, требуемых популярных интернет сайтов, как сказано в задании
	$settings = DB::table('settings');
	if ($settings->where('title', '=', 'siteviews')->count() == 0) {
		DB::insert('insert into settings (title, int_value, int_value2, txt_value) values (?, ?, ?, ?)', ['siteviews', 0, 0, 'empty']); // в случае если параметра о количестве показов сайта нет, добавляем
	}
	$vc = $settings->where('title', '=', 'siteviews')->value('int_value'); // посещения просто для статистики
	$vc2 = $settings->where('title', '=', 'siteviews')->value('int_value2'); // для поочередного парсинга
	$vc++;
	$vc2++;
	if ($vc2==5){ 
		$vc2 = 1;
	}
	DB::update('update settings set int_value = ?,  int_value2 = ? where title = ?',[$vc, $vc2, 'siteviews']); // здесь же, только обновляем

	// конечно это все можно добавлять тоже в базу, чтобы можно было редактировать без входа в код
	$url[1] = "https://informburo.kz/xml/rss.xml"; // Информбюро
	$url[2] = "https://www.mk.ru/rss/incident/index.xml"; // Московский комсомолец - проишествия
	$url[3] = "https://ru.sputniknews.kz/export/rss2/archive/index.xml"; // Спутник ньюс
	$url[4] = "https://vlast.kz/feed/"; // Власть КЗ
	$url[5] = "http://nomad.su/rss/rss.xml"; // Кочевник КЗ

	$rss = simplexml_load_file($url[$vc2]);
	// echo $url[$vc2];
	
	foreach ($rss->channel->item as $items) {
		if ($parsing->where('url', '=', $items->link)->count() <= 0) { // проверяю, чтобы те новости которые уже скопированы в базу, не копировались снова, проверку делаем по ссылке
			$link = $items->link;


			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $link);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$answer = curl_exec($ch);
			$dom = new simple_html_dom();
			$html = str_get_html($answer);
			if(strlen($html)>0){
				
				$list = $html->find("p");			
				if(count($list)>0){
					$body = ''; // основной текст (по заданию нужно все копировать в базу)
					foreach ($list as $p) {
						$body .= $p;
						/*
						if($p->first_child()!=null){
							if(($p->first_child()->find("a"))){ // из некторых сайтов ссылки копировались, очищаем
								$body .= $p;
							}
						}
						*/
					}
				}
				DB::insert('insert into parsing (title, body, dsc, views, url) values (?, ?, ?, ?, ?)', [$items->title, $body, $items->description, 0, $items->link]);
			}
		}
	}

	$parsing = DB::table('parsing')->paginate(10);
	
	$popular = DB::table('parsing')->orderBy('views', 'desc')->paginate(5);
	
	$page = 'welcome';
    return view('welcome', compact('parsing', 'popular', 'page'));
});

Route::get('about', function () {
	$page = 'about';
    return view('about', compact('page'));
});

Route::get('howitis', function () {
	$page = 'howitis';	
    return view('howitis', compact('page'));
});

Route::get('post/{post}', function($post)
{
	$parsing_raw = DB::table('parsing')->where("id", $post); // сначала получаем объект
	$parsing = $parsing_raw->get(); // а затем уже переводим в массив
	$vc = $parsing_raw->value('views'); // просмотры статьи
	$vc++; // плюс один просмотр 
	DB::update('update parsing set views = ? where id = ?',[$vc, $post]); // здесь же, только обновляем

	$page = 'post';
	return view('post', compact('parsing', 'page', 'vc'));
});

Route::get('ajax/{post}', function($post) {
	$parsing = DB::table('parsing')->where("id", $post)->get();
	return view('ajax', compact('parsing'));
});
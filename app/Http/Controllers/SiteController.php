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

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
include_once 'simple_html_dom.php'; // функции для упрощения парсинга

class SiteController extends Controller
{
// главная страница
    public function index(){
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
		if ($vc2==6){
			$vc2 = 1;
		}
		DB::update('update settings set int_value = ?,  int_value2 = ? where title = ?',[$vc, $vc2, 'siteviews']); // здесь же, только обновляем

		// конечно это все можно добавлять тоже в базу, чтобы можно было редактировать без входа в код
		$url[1] = "https://informburo.kz/xml/rss.xml"; // Информбюро
		$url[2] = "https://www.sports.kz/rss"; // Спортс KZ
		$url[3] = "https://www.mk.ru/rss/incident/index.xml"; // Московский комсомолец, раздел проишествия
		$url[4] = "https://ru.sputniknews.kz/export/rss2/archive/index.xml"; // Спутник ньюс
		$url[5] = "https://vlast.kz/feed/"; // Власть KZ
		$url[6] = "http://nomad.su/rss/rss.xml"; // Кочевник

		$rss = simplexml_load_file($url[$vc2]);
		// echo $url[$vc2];
		
		foreach ($rss->channel->item as $items) {
			if ($parsing->where('url', '=', $items->link)->count() <= 0) { // проверяю, чтобы те новости которые уже скопированы в базу, не копировались снова, проверку делаем по ссылке
				$link = $items->link;

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $link);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				$answer = curl_exec($ch);
				$html = str_get_html($answer);
				if(strlen($html)>0){
					
					$list = $html->find("p");			
					if(count($list)>0){
						$body = ''; // основной текст (по заданию нужно все копировать в базу)
						foreach ($list as $p) {
							$body .= preg_replace('#<a.*>.*</a>#USi', '', $p);	// удаляем все ссылки
						}
					}
					DB::insert('insert into parsing (title, body, dsc, views, url, created_at) values (?, ?, ?, ?, ?, ?)', [$items->title, $body, $items->description, 0, $items->link, date("Y-m-d H:i:s", strtotime($items->pubDate))]);
				}
			}
		}

		$parsing = DB::table('parsing')->orderBy('id', 'desc')->paginate(10);
		
		$popular = DB::table('parsing')->orderBy('views', 'desc')->limit(5)->get();
		
		$page = 'welcome';
		return view('welcome', compact('parsing', 'popular', 'page'));
	}
	
// пост
    public function post_page($post){
		$parsing_raw = DB::table('parsing')->where("id", $post); // сначала получаем объект
		$parsing = $parsing_raw->get(); // а затем уже переводим в массив
		$vc = $parsing_raw->value('views'); // просмотры статьи
		$vc++; // плюс один просмотр 
		DB::update('update parsing set views = ? where id = ?',[$vc, $post]); // здесь же, только обновляем

		$page = 'post';
		return view('post', compact('parsing', 'page', 'vc'));
	}
	
//для AJAX запросов	
    public function ajax($post){
		$parsing = DB::table('parsing')->where("id", $post)->get();
		return view('ajax', compact('parsing'));
	}
	
    public function about(){
		$page = 'about';
		return view('about', compact('page'));
	}
	
    public function howitis(){
		$page = 'howitis';	
		return view('howitis', compact('page'));
	}
}
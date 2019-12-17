<!DOCTYPE html>
			@include('header')
			
			<p>Сайт разработал Искаков Мансур, как тестовое задание для работы в ПГУ :-)</p>
			<p>На странице "как разрабатывалось" вы сможете ознакомиться с процессом разработки сайта, правда там не до конца все документировано.</p>
			<p>Сайт делает парсинг следующих новостных ресурсов:</p>
			<ul>
				<li>https://informburo.kz/xml -  Информбюро</li>
				<li>https://ru.sputniknews.kz - Спутник ньюс</li>
				<li>https://www.mk.ru/ - Московский комсомолец, раздел проишествия</li>
				<li>https://www.sports.kz/ - Спортс KZ</li>				
				<li>https://vlast.kz - Власть KZ</li>
				<li>http://nomad.su - Кочевник SU</li>
			</ul>
			<p>Найти сайты с RSS оказалось не так то просто, в большинстве сайтов они отсутствуют, либо присутствует только значок RSS, а сам XML файл отсутствует.</p>
			<p>Во время тестирования некоторые сайты выдали ссылки на другие внутренние статьи сайта, они сохранились в базе, их конечно можно убрать, но оставил, так как особо не мешает для чтения.</p>
			<p>А так же, дата и время новостей имеется не во всех статьях в базе данных, так как на ранних этапах тестирования работы скриптов сохранение даты и времени отустствовало (имею ввиду база на хостинге pgu.iskakovstudio.kz).</p>
			<hr>			
			<center><img src='http://pgu.iskakovstudio.kz/HNY.jpg'></center>
			<hr>
		</div>
    </body>
</html>

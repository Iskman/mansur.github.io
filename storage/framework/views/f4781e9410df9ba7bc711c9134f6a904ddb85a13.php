<!DOCTYPE html>
			<?php echo $__env->make('header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			
			<p>Сайт разработал Искаков Мансур, как тестовое задание для работу в ПГУ :-)</p>
			<p>На странице "как разрабатывалось" вы сможете ознакомиться с процессом разработки сайта, правда там не до конца все документировано.</p>
			<p>Сайт делает парсинг следующие новостные ресурсы:</p>
			<ul>
				<li>https://informburo.kz/xml -  Информбюро</li>
				<li>https://ru.sputniknews.kz - Спутник ньюс</li>
				<li>https://www.mk.ru/ - Московский комсомолец, раздел проишествия</li>
				<li>https://www.sports.kz/ - Спортс KZ</li>				
				<li>https://vlast.kz - Власть КЗ</li>
				<li>http://nomad.su - Кочевник КЗ</li>
			</ul>
			<p>Найти сайты с RSS оказалось не так то просто, в большинстве сайтов они отсутствуют, либо присутствует только значок RSS, а сам XML файл отсутствует.</p>
			<p>Некоторые сайты выдали ссылки на другие внутренние статьи сайта, их конечно можно убрать, но оставил, так как особо не мешает для чтения.</p>
			<br>
			<center><img src='http://pgu.iskakovstudio.kz/HNY.jpg'></center>
		</div>
    </body>
</html>
<?php /**PATH C:\OpenServer\OSPanel\domains\pgu-parser.kz\resources\views/about.blade.php ENDPATH**/ ?>
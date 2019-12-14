<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ТЕСТОВОЕ ЗАДАНИЕ МАНСУРА, ПАРСИНГ RSS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

		<!-- использование BOOTSTRAP требование как было в тестовом задании-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="http://pgu-parser.kz/js/jquery-3.4.1.min.js"></script>
		<script src="http://pgu-parser.kz/js/bootstrap.min.js"></script>
		<style>
			.modal {
			  overflow-y: auto;
			}
			.modal-open {
			  overflow: auto;
			}
		</style>
    </head>
    <body>
		<div class="container">
		
		
<h1>ТЕСТОВОЕ ЗАДАНИЕ МАНСУРА</h1>
<h3 class='text-muted'>ДЛЯ ПАВЛОДАРСКОГО ГОСУДАРСТВЕННОГО УНИВЕРСИТЕТА</h3>
<h4 class='text-muted'>ПАРСИНГ RSS ЛЕНТ / СОХРАНИЕНИЕ В БД / AJAX ЗАГРУЗКА / ПАГИНАЦИЯ / СЧЕТЧИК ПРОСМОТРОВ / BOOTSTRAP / LARAVEL</h4>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<ul class="nav navbar-nav">
			<li class="@if ($page == 'welcome') active @endif"><a href="http://pgu-parser.kz/">ГЛАВНАЯ</a></li>
			<li class="@if ($page == 'about') active @endif"><a href="http://pgu-parser.kz/about">О САЙТЕ</a></li>
			<li class="@if ($page == 'howitis') active @endif"><a href="http://pgu-parser.kz/howitis">КАК РАЗРАБАТЫВАЛОСЬ</a></li>
			<!-- <li class="@if ($page == 'home') active @endif"><a href="#" id='JOKER'>ДЛЯ КРАСОТЫ</a></li> -->
		</ul>
	</div>
</nav>


<!-- Модальное окно -->  
<div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">ПОПУЛЯРНАЯ НОВОСТЬ</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$("#JOKER").click(function(){
			
			alert('Это всего лишь дополнительный пункт меню для красоты, чтобы меню не пустовало.');
		});
		$(".ajax").click(function(event){
			$('#show').modal('show');
			$(".modal-body").load($(this).attr("href"));
			event.preventDefault();			
		});
		$("#show").click(function(event){
			$('#show').modal('hide');
		});
	});
</script>
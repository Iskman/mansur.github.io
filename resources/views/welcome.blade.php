<!DOCTYPE html>
			@include('header')

			<h3 class="text-muted">ПОПУЛЯРНОЕ (статьи с наиболшим количеством просмотров)</h3>
			<ul class="list-unstyled">
				@foreach ($popular as $prs)
					<li><font class="text-muted">[{{ $loop->index+1 }}]</font>&nbsp;<a href="ajax/{{$prs->id}}" class='ajax'>{{ $prs->title }}</a></li>
				@endforeach
			</ul>
			<h3 class='text-muted'>ВСЕ НОВОСТИ</h3>
			<ul class="list-unstyled">
				@foreach ($parsing as $prs)
					<li><a href="post/{{$prs->id}}">{{ $prs->title }}</a><p>{{ $prs->dsc }}</p></li>
				@endforeach
			</ul>
			{{$parsing->links()}}
		</div>
    </body>
</html>

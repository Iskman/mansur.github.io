<!DOCTYPE html>
			@include('header')

			@foreach ($parsing as $prs)
				<h3>{{ $prs->title }}</h3><p>{!! $prs->body !!}</p>
			@endforeach
			<hr>
			<h4 class='text-muted'>Просмотров: {{$vc}}</h4>
		</div>
    </body>
</html>

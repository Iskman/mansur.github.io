@foreach ($parsing as $prs)
	<h3>{{ $prs->title }}</h3><p>{!! $prs->body !!}</p>
@endforeach
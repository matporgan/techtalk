@extends('layout')

@section('content')
	
	<h1>{!! $org->name !!}</h1>
	<p>
		{{ $org->logo }}<br/>
		{{ $org->short_desc }}<br/>
		{{ $org->long_desc }}<br/>
		{{ $org->website }}<br/><br/>

		Technologies:
		<ul>
			@foreach($org->technologies as $technology)
				<li>{{ $technology->name }}</li>
			@endforeach
		</ul>

		Industries:
		<ul>
			@foreach($org->industries as $industry)
				<li>{{ $industry->name }}</li>
			@endforeach
		</ul>

		Domains:
		<ul>
			@foreach($org->domains as $domain)
				<li>{{ $domain->name }}</li>
			@endforeach
		</ul>

		Tags:
		<ul>
			@foreach($org->tags as $tag)
				<li>{{ $tag->name }}</li>
			@endforeach
		</ul>

		Documents:
		<ul>
			@foreach($org->documents as $document)
				<li><a href="/document/{{ $document->id }}">{{ $document->name }} | {{ $document->description }}</a></li>
			@endforeach
		</ul>

		Links:
		<ul>
			@foreach($org->links as $link)
				<li><a href="{{ $link->url }}">{{ $link->url }} | {{ $link->description }}</a></li>
			@endforeach
		</ul>
	</p>



	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />

	<script type="text/javascript">
		$(document).ready(function() {
			$(".fancybox").fancybox({
				padding : 0,
				width: '110%'
			});
		});
		
		$(".fancybox")
    .attr('rel', 'gallery')
    .fancybox({
        padding: 0
    });
	</script>

	<a class="fancybox btn btn-primary" href="#document_form">Upload Document</a>
	
	<a href="{{ $org->id }}/edit">EDIT</a> | <a href="{{ $org->id }}">DELETE</a>
	
	<div id="document_form" style="padding: 10px 15px;">
		<div class="row col-md-12">
			{!! Form::open(['method' => 'POST', 'action' => ['DocumentsController@addDocument', $org->id], 'files' => true]) !!}
				<h2>Add Document</h2>
				<div class="form-group">
					{!! Form::label('upload', 'Upload:') !!}
					{!! Form::file('upload', ['id' => 'upload']) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('name', 'Name:') !!}
					{!! Form::text('name', null, ['id' => 'filename', 'class' => 'form-control']) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('description', 'Description:') !!}
					{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
				</div>
				
				<div class="form-group">
					{!! Form::submit('Add Document', ['class' => 'btn btn-primary pull-right']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
	
	<script type="text/javascript">
		$('#upload').change(function() {
		    var filename = $(this).val();
		    var lastIndex = filename.lastIndexOf("\\");
		    if (lastIndex >= 0) {
		        filename = filename.substring(lastIndex + 1);
		    }
		    $('#filename').val(filename.replace(/\.[^/.]+$/, ""));
		});
	</script>
	
	<div class="row">
		{!! Form::open(['method' => 'POST', 'action' => ['LinksController@addLink', $org->id]]) !!}
			<div class="form-group">
				{!! Form::label('url', 'URL:') !!}
				{!! Form::text('url', null, ['class' => 'form-control']) !!}
			</div>
			
			<div class="form-group">
				{!! Form::label('description', 'Description:') !!}
				{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
			</div>
			
			<div class="col-md-12">
				<div class="form-group">
					{!! Form::submit('Add Link', ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>

@stop
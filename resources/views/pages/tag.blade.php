@extends('layout')

@section('content')

    <h1>Tag: {{ $tag->name }}</h1>

    @foreach($org_list as $org)
    	<li><a href="/orgs/{{ $org->id }}">{{ $org->name }}</a></li>
    @endforeach

@stop
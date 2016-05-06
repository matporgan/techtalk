@extends('layout')

@section('content')

    <h1>Domain: {{ $domain->alias }}</h1>

    @foreach($org_list as $org)
    	<li><a href="/orgs/{{ $org->id }}">{{ $org->name }}</a></li>
    @endforeach

@stop
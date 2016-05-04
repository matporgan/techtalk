@extends('layout')

@section('content')

    @foreach($org_list as $org)
    	<li><a href="/orgs/{{ $org->id }}">{{ $org->name }}</a></li>
    @endforeach

@stop
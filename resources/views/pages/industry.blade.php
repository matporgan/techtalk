@extends('layout')

@section('content')

<h1>Industry: {{ $industry->name }}</h1>

@include('snippets.org-grid')

@stop
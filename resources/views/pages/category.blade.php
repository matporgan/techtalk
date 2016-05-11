@extends('layout')

@section('content')

<h1>{{ $type }}: {{ $category->name }}</h1>

@include('snippets.org-grid')

@stop
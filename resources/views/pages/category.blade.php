@extends('layouts.app')

@section('content')

<h1>{{ $type }}: {{ $category->name }}</h1>

@include('orgs._grid')

@stop
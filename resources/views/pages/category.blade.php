@extends('layouts.app')

@section('content')

<div class="container">

<h1>{{ $type }}: {{ $category->name }}</h1>

@include('orgs._grid')

</div>

@stop
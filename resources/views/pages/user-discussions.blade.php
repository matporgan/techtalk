@extends('layouts.app')

@section('content')

<div class="row">

	<div class="col s12">

		<div class="row">
			<h1 class="center">My Discussions</h1>
		</div>
		
		<div class="row">
			<div class="col s12 m6 offset-m3">
			<form>
				<div class="input-field">
					<input id="search" type="search">
					<label for="search"><i class="material-icons prefix">search</i></label>
				</div>
			</form>
			</div>
			
			<div class="col s12 m3" style="margin-top:30px;">
				<a class="btn right waves-effect waves-light" href="/discussions/create">Add</a>
			</div>
		</div>
		
		<div class="row center">
			@include('discussions._board')
		</div>

	</div>

</div>

@stop
@extends('layouts.app')

@section('content')

<div class="row">

	<div class="col s12">

		<div class="row header-btn-wrapper">
			<h1 class="center">Organisations</h1>
			<div class="header-btn">
				<a class="btn-large right waves-effect waves-light" href="orgs/create">
					<i class="material-icons left">add</i>Add
			  	</a>
			</div>
		</div>

		<div class="row">
			<form>
				<div class="col s12 m8 l6 offset-m2 offset-l3">
					<div class="input-field">
						<i class="material-icons prefix">search</i>
						<input id="search" type="search" disabled required>
						<label for="search"></label>
					</div>
				</div>
			</form>
		</div>

		@include('orgs._grid')

	</div> <!-- END col -->

</div> <!-- END row -->

@stop
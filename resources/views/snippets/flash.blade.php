@if(Session::has('success'))
	<script type="text/javascript">
		Materialize.toast('{{ Session::get('success') }}', 4000, 'toast-success');
	</script>
@elseif(Session::has('failure'))
	<script type="text/javascript">
		Materialize.toast('{{ Session::get('failure') }}', 4000, 'toast-failure');
	</script>
@endif
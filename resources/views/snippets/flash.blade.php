<script type="text/javascript">

	@if(Session::has('success'))
		Materialize.toast('{{ Session::get('success') }}', 4000, 'toast-success');
	@elseif(Session::has('failure'))
		Materialize.toast('{{ Session::get('failure') }}', 4000, 'toast-failure');
	@endif
	
</script>
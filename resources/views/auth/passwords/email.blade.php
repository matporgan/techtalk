@extends('layouts.app')

<!-- Main Content -->
@section('content')

<h1 class="center">Reset Password</h1><br />

<div class="row">
    <form class="col s12 m8 l6 offset-m2 offset-l3" id="reset-password" role="form" method="POST" action="{{ url('/password/email') }}">

        {!! csrf_field() !!}

        <div class="input-field">
            {!! Form::label('email', 'Email', ['class' => 'active']) !!}
            {!! Form::text('email', null, ['id' => 'email']) !!}
        </div><br />

        <div class="row center">
            <button class="btn-large waves-effect waves-light" type="submit" name="action">
                Send<i class="material-icons left">send</i>
            </button>
        </div>

    </form>
</div>

<script type="text/javascript">
    $("#reset-password").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
</script>

@endsection

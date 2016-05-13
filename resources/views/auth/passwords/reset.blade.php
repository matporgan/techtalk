@extends('layouts.app')

@section('content')

<h1 class="center">Login</h1><br />

<div class="row">
    <form class="col s12 m8 l6 offset-m2 offset-l3" id="complete-reset" role="form" method="POST" action="{{ url('/password/reset') }}">
        {!! csrf_field() !!}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="input-field">
            {!! Form::label('email', 'Email', ['class' => 'active']) !!}
            {!! Form::text('email', $email, ['id' => 'email']) !!}
        </div>

        <div class="input-field">
            {!! Form::label('password', 'New Password', ['class' => 'active']) !!}
            {!! Form::password('password', null, ['id' => 'password']) !!}
        </div>

        <div class="input-field">
            {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'active']) !!}
            {!! Form::password('password_confirmation', null, ['id' => 'password_confirmation']) !!}
        </div><br />

        <div class="row center">
            <button class="btn-large waves-effect waves-light" type="submit" name="action">
                Reset<i class="material-icons left">sync</i>
            </button>
        </div>

    </form>
</div>

<script type="text/javascript">
    $("#complete-reset").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6,
            },
            password_confirmation: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
        },
        messages: {
            password_confirmation: {
                equalTo: "Passwords do not match." 
            }
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

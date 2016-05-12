@extends('layout')

@section('content')

<h1 class="center">Login</h1><br />

<div class="row">
    <form class="col s12 m8 l6 offset-m2 offset-l3" id="login" role="form" method="POST" action="{{ url('/login') }}">

        {!! csrf_field() !!}

        <div class="input-field">
            {!! Form::label('email', 'Email', ['class' => 'active']) !!}
            {!! Form::text('email', null, ['id' => 'email']) !!}
        </div>

        <div class="input-field">
            {!! Form::label('password', 'Password', ['class' => 'active']) !!}
            {!! Form::password('password', null, ['id' => 'password']) !!}
        </div>

        <div class="input-field">
            <input type="checkbox" name="remember" id="remember" />
            <label for="remember">Remember Me</label>
        </div><br /><br />

        <div class="row center">
            <button class="btn-large waves-effect waves-light" type="submit" name="action">
                Login<i class="material-icons left">lock_open</i>
            </button>            
        </div>
        
        <div class="row center">
            <span class="subtitle"><a href="/password/reset">Forgot your password?</a></span>
        </div>

    </form>
</div>

<script type="text/javascript">
    $("#login").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: "required",
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
@extends('layouts.app')

@section('content')

<h1 class="center">Register</h1><br />

<div class="row">
    <form class="col s12 m8 l6 offset-m2 offset-l3" id="register" role="form" method="POST" action="{{ url('/register') }}">
        {!! csrf_field() !!}

        <div class="input-field">
            {!! Form::label('first_name', 'First Name', ['class' => 'active']) !!}
            {!! Form::text('first_name', null, ['id' => 'first_name']) !!}
        </div>
        
        <div class="input-field">
            {!! Form::label('last_name', 'Last Name', ['class' => 'active']) !!}
            {!! Form::text('last_name', null, ['id' => 'last_name']) !!}
        </div>
        
        <div class="input-field">
            {!! Form::label('city', 'City', ['class' => 'active']) !!}
            {!! Form::text('city', null, ['id' => 'city']) !!}
        </div>

        <div class="input-field">
            {!! Form::label('email', 'Email', ['class' => 'active']) !!}
            {!! Form::text('email', null, ['id' => 'email']) !!}
        </div>

        <div class="input-field">
            {!! Form::label('password', 'Password', ['class' => 'active']) !!}
            {!! Form::password('password', null, ['id' => 'password']) !!}
        </div>

        <div class="input-field">
            {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'active']) !!}
            {!! Form::password('password_confirmation', null, ['id' => 'password_confirmation']) !!}
        </div><br />

        <div class="row center">
            <button class="btn-large waves-effect waves-light" type="submit" name="action">
                Register<i class="material-icons right">send</i>
            </button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $("#register").validate({
        rules: {
            first_name: "required",
            last_name: "required",
            city: "required",
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
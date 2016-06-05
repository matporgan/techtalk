@extends('layouts.app')

@section('content')

<div class="container">

<h1 class="center">{{ $user->getName() }}</h1><br />

<h2 class="center">Notifications</h2><br />

<div class="row">
    <div class="col s12 m6 offset-m3">
    	{!! Form::open(['method' => 'POST', 'action' => ['PreferencesController@updateNotify']]) !!}
    	    <div class="input-field">
    			{!! Form::select('notify_frequency', ['None'=>'None', 'Instant'=>'Instant', 'Daily'=>'Daily', 'Weekly'=>'Weekly', 'Monthly'=>'Monthly'], $user->notify_frequency) !!}
    			{!! Form::label('notify_frequency', 'Notification Frequency') !!}<br />
    		</div>
    		
    		<div class="row right">
            	<button class="btn waves-effect waves-light" type="submit" name="action">
            	    	Update<i class="material-icons left">sync</i>
              	</button>
            </div>
    	{!! Form::close() !!}
    </div>
</div>

<h2 class="center">Change Password</h2><br />

<div class="row">
    <div class="col s12 m6 offset-m3">
    	{!! Form::open(['method' => 'POST', 'action' => ['PreferencesController@updatePassword'], 'id' => 'update-password']) !!}
    	    <div class="input-field">
                {!! Form::label('password', 'Password', ['class' => 'active']) !!}
                {!! Form::password('password', null, ['id' => 'password']) !!}
            </div>
    
            <div class="input-field">
                {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'active']) !!}
                {!! Form::password('password_confirmation', null, ['id' => 'password_confirmation']) !!}
            </div>
    		
    		<div class="row right">
            	<button class="btn waves-effect waves-light" type="submit" name="action">
            	    	Update<i class="material-icons left">sync</i>
              	</button>
            </div>
    	{!! Form::close() !!}
    </div>
</div>

</div>

<script type="text/javascript">
    $("#update-password").validate({
        rules: {
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

@stop
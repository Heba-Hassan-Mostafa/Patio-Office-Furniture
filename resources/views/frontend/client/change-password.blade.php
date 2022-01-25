@extends('frontend.home')

@section('content')

		<div class="container">
			<div class="row">
                <div class="col-md-5">
                 <div class="account-pade-details">
                    <div class="account-box"><img src="{{ asset("frontend/images/user.png") }}">
                        <h6>{{ Auth::user()->name }}</h6>
                        <hr>
                        <a href="{{ route('change.password') }}">Change Password</a>
                        <hr>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger out-style">Log Out</a>
                    </div>
                 </div>
                </div>

                <div class="col-md-7" style="margin-top: 20px">
            <div class="card-change-pass">
                <div class="change-title-pass">Change Password</div>
                <div class="card-body">
                    {!! Form::open(
                    [
                    'action'=>'FrontendController\ClientController@changePasswordSave' ,
                    'method' =>'post',
                    'id'=>"contact_form"
                    ])
                        !!}
                    <div class="form-group">
                        {!! Form::password('current_password' ,['class'=>'form-control','placeholder'=>'Enter Your Old Password']) !!}
                            @error('current_password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        {!! Form::password('password' ,['class'=>'form-control','placeholder'=>'Enter Your New Password']) !!}
                            {{-- @error('password')<span class="text-danger">{{ $message }}</span>@enderror --}}
                    </div>

                            <div class="form-group">
                        {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Enter Your New Password Conformation']) !!}
                        {{-- @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror --}}
                        </div>

                        <div class="change-pass-button">
                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                        </div>
                            {!! Form::close() !!}
                                </div>
            </div>
        </div>
    </div>
		</div>


@endsection

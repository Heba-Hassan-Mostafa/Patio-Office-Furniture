@extends('frontend.home')

@section('content')
{{--
        <!-- wrapper -->
          <div class="wrapper without_header_sidebar">
            <!-- contnet wrapper -->
            <div class="content_wrapper">
                    <!-- page content -->
                    <div class="login_page center_container">
                        <div class="center_content" style="
                                            width: 300px;
                                            margin: auto;
                                            margin-top: 40px;
                                            border-radius: 5px;
                                            box-shadow: 1px 1px 20px #ddd;">

        {!! Form::open(
            [
            'action'=>'Auth\LoginController@login' ,
            'method' =>'post',
            ])
                !!}
                {!! Form::email('email',old('email') ,['class'=>'form-control' ,'placeholder'=>"Email"]) !!}
                @error('email')<span class="text-danger">{{ $message }}</span>@enderror

                {!! Form::password('password',['class'=>'form-control' , 'placeholder'=>"Password"]) !!}
                @error('password')<span class="text-danger">{{ $message }}</span>@enderror

        <div class="form-group">
         <a href="{{ route('password.request') }}" class="text-white">I forgot my password</a>
         {!! Form::submit('Log In') !!}
        </div>
      {!! Form::close() !!}
 

        </div>
        
                    </div>
            </div><!--/ content wrapper -->
        </div><!--/ wrapper --> --}}


        <!-- -login-and-sign-up--------------------------------->
<div class="container mt-3 mb-3">
    <p class="text-center font-weight-bold text-danger" style="margin:10px">you must login first</p>
    <div class="row justify-content-around">
        <div class="col-md-5"
            style="border-radius: 5px;
            box-shadow: 1px 1px 20px #ddd;">
            <p class="text-center font-weight-bold"
               style="margin: 35px;
               font-size: 26px;">login</p>
               {!! Form::open(
                [
              'action'=>'Auth\LoginController@login' ,
               'method' =>'post',
                ])
                 !!}
                 {!! Form::label('email','Email',['class'=>"font-weight-bold text-secondary"]) !!}
                  {!! Form::email('email',old('email') ,['class'=>'form-control' ,'placeholder'=>"Email"]) !!}
                  @error('email')<span class="text-danger">{{ $message }}</span>@enderror

                  {!! Form::label('password','Password',['class'=>"font-weight-bold text-secondary mt-3"]) !!}
                  {!! Form::password('password',['class'=>'form-control' , 'placeholder'=>"Password"]) !!}
                  @error('password')<span class="text-danger">{{ $message }}</span>@enderror

                <div class="row">
                    <div>
                        <a href="{{ route('password.request') }}" class="m-3">Forget Your Password?</a>
                    </div>
                </div>

                {!! Form::submit('Log In',['class'=>"d-block btn btn-success font-weight-bold", 'style'=>"margin: 10px auto"]) !!}
                {!! Form::close() !!}
                 <!--<a href="{{ url('/auth/redirect/google') }}" class="btn btn-danger btn-block">-->
                 <!--       <i class="fab fa-google"></i> Google</a>-->
                 
                 <!--<a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-info btn-block">-->
                 <!--       <i class="fab fa-facebook"></i> Facebook</a>-->
            </div>

        <div class="col-md-5"
            style="border-radius: 5px;
            box-shadow: 1px 1px 20px #ddd;">
            <p class="text-center font-weight-bold"
            style="margin: 35px;
            font-size: 26px;">Sign Up</p>
            {!! Form::open(
                [
                'action'=>'Auth\RegisterController@register' ,
                'method' =>'post',
                ])
                 !!}
                 {!! Form::label('first_name','First Name',['class'=>"font-weight-bold text-secondary"]) !!}
                 {!! Form::text('first_name',old('first_name') ,['class'=>'form-control','placeholder'=>'First Name']) !!}
                 @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                 {!! Form::label('name','Last Name',['class'=>"font-weight-bold text-secondary"]) !!}
                 {!! Form::text('name',old('name') ,['class'=>'form-control','placeholder'=>'Last Name']) !!}
                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                {!! Form::label('email','Email',['class'=>"font-weight-bold text-secondary"]) !!}
                {!! Form::email('email',old('email') ,['class'=>'form-control','placeholder'=>'E-mail']) !!}
                 @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                 {!! Form::label('phone','Phone',['class'=>"font-weight-bold text-secondary"]) !!}
                 {!! Form::text('phone',old('phone') ,['class'=>'form-control','placeholder'=>'Phone']) !!}
                 @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                 {!! Form::label('password','Password',['class'=>"font-weight-bold text-secondary"]) !!}
                 {!! Form::password('password' ,['class'=>'form-control','placeholder'=>'Password']) !!}
                 @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                 {!! Form::label('password_confirmation','Repeat Password',['class'=>"font-weight-bold text-secondary"]) !!}
                 {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Your Password Conformation']) !!}
                 @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                 {!! Form::submit('Sign Up',['class'=>"d-block btn btn-success font-weight-bold" ,'style'=>"margin: 10px auto"]) !!}
              {!! Form::close() !!}
              
                <!--<a href="{{ url('/auth/redirect/google') }}" class="btn btn-danger btn-block">-->
                <!--        <i class="fab fa-google"></i> Google</a>-->

        </div>
    </div>

</div>


@endsection

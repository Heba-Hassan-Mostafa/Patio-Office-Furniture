@extends('layouts.admin')

@section('content')

 <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin <span class="tx-info tx-normal">Reset Password</span></div>
        <div class="tx-center mg-b-60"></div>


         {!! Form::open(['action'=>'Admin\ResetPasswordController@reset' , 'method' => 'post']) !!}

         <div class="form-group">
            {!! Form::text('pin_code', null, ['class' => 'form-control ', 'placeholder' => 'Code']) !!}
        </div>
         <div class="form-group">
          {!! Form::email('email', old('email'), ['class' => 'form-control ', 'placeholder' => 'Email']) !!}
          @error('email') <span class="text-danger">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        {!! Form::password('password', ['class' => 'form-control ', 'placeholder' => 'password']) !!}
        @error('password') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        {!! Form::password('password_confirmation', ['class' => 'form-control ', 'placeholder' => 'Confirm password']) !!}
        @error('password_confirmation') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

      {!! Form::button('Send', ['type' => 'submit', 'class' => 'btn btn-info btn-block']) !!}

      {!! Form::close() !!}


      </div><!-- login-wrapper -->
    </div><!-- d-flex -->




@endsection

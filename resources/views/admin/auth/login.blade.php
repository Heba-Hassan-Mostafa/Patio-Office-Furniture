@extends('layouts.admin')

@section('content')

 <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Admin <span class="tx-info tx-normal">Panel</span></div>
        <div class="tx-center mg-b-60"></div>


         {!! Form::open(['route' => 'admin.login', 'method' => 'post']) !!}
      <div class="form-group">
          {!! Form::email('email', old('email'), ['class' => 'form-control ', 'placeholder' => 'Enter your Email']) !!}
          @error('email') <span class="text-danger">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
          {!! Form::password('password', ['class' => 'form-control ', 'placeholder' => 'Enter your password']) !!}
           <a href="{{ adminurl('reset/password') }}" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
          @error('password') <span class="text-danger">{{ $message }}</span>@enderror
      </div>

        <div class="form-group">
            <input  type="checkbox" name="remember"  {{ old('remember') ? 'checked' : '' }}>
            <label  for="remember">Remember Me</label>
      </div>
      {!! Form::button('Sign In', ['type' => 'submit', 'class' => 'btn btn-info btn-block']) !!}

      {!! Form::close() !!}


      </div><!-- login-wrapper -->
    </div><!-- d-flex -->




@endsection

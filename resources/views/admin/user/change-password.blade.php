@extends('admin.app')

@section('content')

            <div class="sl-pagebody">
                <div class="sl-page-title">
                <h5>Change Password</h5>
                </div><!-- sl-page-title -->

            <!-- /.card-header -->
            <div class="card pd-20 pd-sm-40">
            <h6 class="m-0 font-weight-bold card-body-title "> Admin Change Password</h6>
            <div class="card-body">

                {!! Form::open(
                    [
                    'action'=>'AdminController@changePasswordSave' ,
                    'method' =>'post',
                    'id'=>"contact_form"
                    ])
                        !!}
                    <div class="form-group">
                        {!! Form::label('current_password','Current Password') !!}
                        {!! Form::password('current_password' ,['class'=>'form-control','placeholder'=>'Enter Your Old Password']) !!}
                            {{-- @error('current_password')<span class="text-danger">{{ $message }}</span>@enderror --}}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password','New Password') !!}
                        {!! Form::password('password' ,['class'=>'form-control','placeholder'=>'Enter Your New Password']) !!}
                            {{-- @error('password')<span class="text-danger">{{ $message }}</span>@enderror --}}
                    </div>

                            <div class="form-group">
                        {!! Form::label('password_confirmation','Confirm Password') !!}
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


@endsection

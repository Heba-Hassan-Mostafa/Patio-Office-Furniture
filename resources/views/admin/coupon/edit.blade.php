@extends('admin.app')
@section('content')



<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Coupon Table</h5>
    </div><!-- sl-page-title -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            <div class="ml-auto">
                <a href="{{ adminurl('coupon') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Coupons</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            {!! Form::model($model,
            ['action' => ['BackendController\CouponController@update',$model->id],
             'method' => 'put'])
             !!}
            <div class="row">
                <div class="col-6">
                        <div class="form-group">
                            {!! Form::label('coupon', 'Coupon') !!}
                            {!! Form::text('coupon', old('coupon',$model->coupon), ['class' => 'form-control']) !!}
                            @error('coupon')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                      <div class="col-6">
                        <div class="form-group">
                            {!! Form::label('discount', 'Discount') !!}
                            {!! Form::text('discount', old('discount',$model->discount), ['class' => 'form-control']) !!}
                            @error('discount')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

            <div class="form-group pt-4">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@extends('admin.app')
@section('content')



<div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Category Table</h5>
    </div><!-- sl-page-title -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            <div class="ml-auto">
                <a href="{{ adminurl('category') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Categories</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            {!! Form::model($model,
            ['action' => ['BackendController\SubCategoryController@update',$model->id],
             'method' => 'put'])
             !!}
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', old('name', $model->name), ['class' => 'form-control']) !!}
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                  <div class="col-8">
                       <div class="form-group">
                        {!! Form::label('category_id', 'Category') !!}
                        {!! Form::select('category_id',['' => 'Select Category'] + $categories , old('category_id', $model->category_id), ['class' => ' form-control']) !!}
                        @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    </div>
                <div class="col-8">
                    {!! Form::label('status', 'status') !!}
                    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status', $model->status), ['class' => 'form-control']) !!}
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
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

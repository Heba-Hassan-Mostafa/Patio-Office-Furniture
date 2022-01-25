@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Brand Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="m-0 font-weight-bold card-body-title ">{{ $title }}</h6>
        <div class="ml-auto">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modaldemo3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add new Brand</span>
            </a>
        </div>
      <div class="card-body">
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Name</th>
                <th class="wd-15p">Image</th>
                <th class="wd-20p">Status</th>
                <th class="wd-10p">Created_at</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($brands as $brand)
                <tr class="row1" data-id={{ $brand->id }}>
                    <td>{{ $brand->id }}</td>
                     <td>{{ $brand->name }}</td>
                    <td>
                @if(!empty($brand->image))
        <img src="{{ asset('/files/brands/'.$brand->image) }}" style="width:100px;height: 100px;" />
       @endif
                    </td>
                    <td> @if ($brand->status == 1)

                        <span class="badge badge-success" style="padding: 10px;font-size: 14px;">Active</span>
                        @else
                         <span class="badge badge-danger" style="padding: 10px;font-size: 14px;">Inactive</span>
                        @endif</td>
                    <td>{{ $brand->created_at->format('d-m-Y h:i a') }}</td>
                    <td>
                        <a href="{{ url(route('brand.edit', $brand->id)) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        {!! Form::open(['route'=>['brand.destroy',$brand->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-danger" data-name="{{ $brand->name }}" type="submit"><i class="fa fa-trash"></i></button>                        {!! Form::close() !!}
                    </td>
                </tr>


                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->
   </div>

@include('admin.brands.model')


@endsection

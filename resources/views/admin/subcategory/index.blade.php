@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5> SubCategory Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="m-0 font-weight-bold card-body-title ">{{ $title }}</h6>
        <div class="ml-auto">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modaldemo3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add new SubCategory</span>
            </a>
        </div>
     <div class="card-body">
        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">SubCategory Name</th>
                <th class="wd-15p">Category Name</th>
                <th class="wd-20p">Status</th>
                <th class="wd-10p">Created_at</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($subcats as $cat)
                <tr class="row1" data-id={{ $cat->id }}>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->category->name }}</td>
                    <td>
                        @if ($cat->status == 1)

                        <span class="badge badge-success" style="padding: 10px;font-size: 14px;">Active</span>
                        @else
                         <span class="badge badge-danger" style="padding: 10px;font-size: 14px;">Inactive</span>
                        @endif
                    </td>                    <td>{{ $cat->created_at->format('d-m-Y h:i a') }}</td>
                    <td>
                        <a href="{{ url(route('subcategory.edit', $cat->id)) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        {!! Form::open(['route'=>['subcategory.destroy',$cat->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-danger" data-name="{{ $cat->name }}" type="submit"><i class="fa fa-trash"></i></button>                        {!! Form::close() !!}
                    </td>
                </tr>


                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
        </div>
      </div><!-- card -->


@include('admin.subcategory.model')


@endsection

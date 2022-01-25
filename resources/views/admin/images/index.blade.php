@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Catalogue Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="m-0 font-weight-bold card-body-title ">{{ $title }}</h6>
        <div class="ml-auto">
            <a href="{{ url(route('image.create')) }}"class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add new Image</span>
            </a>
        </div>

        <div class="card-body">

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Catalogue Title</th>
                <th class="wd-15p">Catalogue Category</th>
                <th class="wd-20p">Status</th>
                <th class="wd-10p">Created_at</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($images as $img)
                <tr class="row1" data-id={{ $img->id }}>
                    <td>{{ $img->id }}</td>
                    <td>{{ $img->title }}</td>
                    <td>{{ $img->imageCategory->name }}</td>



        <td>
            @if ($img->status == 1)

            <span class="badge badge-success" style="padding: 10px;font-size: 14px;">Active</span>
            @else
             <span class="badge badge-danger" style="padding: 10px;font-size: 14px;">Inactive</span>
            @endif
        </td>
                    <td>{{ $img->created_at->format('d-m-Y h:i a') }}</td>
                    <td>
                        <a href="{{ url(route('image.edit', $img->id)) }}" class="btn btn-sm btn-success" title="edit"><i class="fa fa-edit"></i></a>
                        {!! Form::open(['route'=>['image.destroy',$img->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-sm btn-danger" data-name="{{ $img->title }}" type="submit" title="delete"><i class="fa fa-trash"></i></button>
                         {!! Form::close() !!}

                      <!--  @if($img->status==1)-->

                      <!--  <a href="{{ URL::to('admin/image/inactive/'.$img->id) }}" class="btn btn-sm btn-danger" title="Inactive"><i class="fa fa-thumbs-down"></i></a>-->
                      <!--  @else-->
                      <!--<a href="{{ URL::to('admin/image/active/'.$img->id) }}" class="btn btn-sm btn-info" title="active"><i class="fa fa-thumbs-up"></i></a>-->
                      <!--  @endif-->
                    </td>
                </tr>


                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->


        </div>


@endsection

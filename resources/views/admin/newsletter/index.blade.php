@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Subscriber Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="m-0 font-weight-bold card-body-title ">{{ $title }}</h6>


   <div class="card-body">

       <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Email</th>
                <th class="wd-10p">Created_at</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($news as $new)
                <tr class="row1" data-id={{ $new->id }}>
                    <td>{{ $new->id }}</td>
                    <td>{{ $new->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($new->created_at)->diffforhumans() }}</td>
                    <td>
                        {!! Form::open(['route'=>['news.destroy',$new->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-danger" data-name="{{ $new->name }}" type="submit"><i class="fa fa-trash"></i></button>
                         {!! Form::close() !!}
                    </td>
                </tr>

               
                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->

   </div>



@endsection

@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Clients Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="m-0 font-weight-bold card-body-title ">Clients List</h6>
        <div class="ml-auto">

        </div>

        <div class="card-body">

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Name</th>
                <th class="wd-20p">Email</th>
                <th class="wd-20p">Phone</th>
                <th class="wd-10p">Created_at</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($users as $user)
                <tr class="row1" data-id={{ $user->id }}>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }} {{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->created_at->format('d-m-Y h:i a') }}</td>
                   <td>
                          {!! Form::open(['route'=>['client.destroy',$user->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-danger" data-name="{{ $user->first_name }}" type="submit"><i class="fa fa-trash"></i></button>
                           {!! Form::close() !!}
                           <a href="{{ url(route('client.show', $user->id)) }}" class="btn btn-info">View</a>
                    </td>
                </tr>


                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->
    </div>

@endsection

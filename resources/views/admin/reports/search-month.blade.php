@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5> Month Report Orders </h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="m-0 font-weight-bold card-body-title "></h6>


   <div class="card-body">

       <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-10p">Name</th>
                <th class="wd-10p">Email</th>
                <th class="wd-10p">Phone</th>
                <th class="wd-10p">Total</th>
                <th class="wd-10p">Date</th>
                <th class="wd-10p">Status</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($orders as $order)
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>${{ $order->total }}</td>
                    <td>{{ $order->date }}</td>
                    <td>
                        @if ($order->status == 0)
                        <span class="badge badge-warning">Pending</span>
                        @elseif ($order->status == 1)
                        <span class="badge badge-info">Payment Accept</span>
                        @elseif ($order->status == 3)
                        <span class="badge badge-success">Delivered</span>
                        @else
                        <span class="badge badge-danger">Cancel</span>
                        @endif</td>
                    <td><a href="{{ URL::to('admin/view/order/'.$order->id) }}" class="btn btn-sm btn-info">View</a></td>
                    {{-- <td>
                        {!! Form::open(['route'=>['orders.destroy',$order->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-danger" data-name="{{ $order->name }}" type="submit"><i class="fa fa-trash"></i></button>
                         {!! Form::close() !!}
                    </td> --}}
                </tr>


                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->

   </div>



@endsection

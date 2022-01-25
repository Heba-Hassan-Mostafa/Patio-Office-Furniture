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
                <th class="wd-15p">Name</th>
                <th class="wd-20p">Email</th>
                <th class="wd-20p">Phone</th>
                <th class="wd-20p">Total</th>
                <th class="wd-20p">Date</th>
                <th class="wd-20p">Status</th>
                <th class="wd-20p">View Products</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($orders as $order)
                <tr class="row1" data-id={{ $order->id }}>
                    <td>{{ $order->first_name }} {{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->total }}</td>
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
                    <td>
                        <a href="{{ URL::to('admin/view/order/'.$order->id) }}" class="btn btn-sm btn-primary">Products</a>
                    </td>

                </tr>


                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->
    </div>

@endsection

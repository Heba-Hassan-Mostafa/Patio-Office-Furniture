@extends('admin.app')

@section('content')

    <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
            <h6 class="m-0 font-weight-bold card-body-title "> Order Details </h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-header "><strong>Order </strong> Details</div>
                    <div class="card-body ">
                        <table class="table">
                            <tr>
                                <th>Name: </th>
                                <th>{{ $order->first_name }} {{ $order->last_name }} </th>
                            </tr>
                            <tr>
                                <th>Phone: </th>
                                <th>{{ $order->phone }} </th>
                            </tr>
                            <tr>
                                <th>Email: </th>
                                <th>{{ $order->email }} </th>
                            </tr>

                            <tr>
                                <th>Total: </th>
                                <th>{{ $order->total }} L.E</th>
                            </tr>
                            <tr>
                                <th>Month: </th>
                                <th>{{ $order->month }} </th>
                            </tr>
                            <tr>
                                <th>Date: </th>
                                <th>{{ $order->date }} </th>
                            </tr>
                            <tr>
                                <th>Note: </th>
                                <th>{{ $order->note }}</th>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <th>
                                    @if ($order->status == 0)
                                    <span class="badge badge-warning">Pending</span>
                                    @elseif ($order->status == 1)
                                    <span class="badge badge-info">Payment Accept</span>
                                    @elseif ($order->status == 3)
                                    <span class="badge badge-success">Delivered</span>
                                    @else
                                    <span class="badge badge-danger">Cancel</span>
                                    @endif
                                </th>
                            </tr>
                        </table>
                    </div>
                    </div>

                </div>


        <div class="col-6 text-center">

                <a href="{{ URL::to('admin/print/order/'.$order->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i>Print</a>
                <a href="{{ URL::to('admin/pdf/order/'.$order->id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-file-pdf"></i>Export PDF</a>
                <a href="{{ URL::to('admin/send/email/order/'.$order->id) }}" class="btn btn-success btn-sm"><i class="fa fa-envelope"></i>Send To Email</a>

            </div>
                </div>

                <div class="row">

      <div class="card pd-20 pd-sm-40 col-lg-12">
        <h6 class="m-0 font-weight-bold card-body-title ">Product Details</h6>

        <div class="card-body">

        <div class="table-wrapper">
          <table class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">Product Code</th>
                <th class="wd-15p">Product Name</th>
                <th class="wd-15p">Image</th>

                <th class="wd-15p">Quantity</th>
                <th class="wd-15p">Price</th>
                <th class="wd-20p">Total Price</th>
                <th class="wd-20p">Order Date</th>

              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($details as $row)
                    <td>{{ $row->product_code }}</td>
                    <td>{{ $row->product->product_name }}</td>
                     <td>
                @if(!empty($row->product->image))
             <img src="{{ asset('/files/products/'.$row->product->image) }}" style="width:50px;height:50px;" />
                @endif
                    </td>
                    <td>{{ $row->quantity }}</td>
                    <td>{{ $row->price }}</td>
                    <td>{{ $row->total_price }}</td>


                    <td>{{ \Carbon\Carbon::parse($row->created_at)->diffforhumans() }}</td>
                </tr>


                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->
        </div>

                </div>
                @if ($order->status == 0)

                <a href="{{ url('admin/accept/payment/'.$order->id) }}" class="btn btn-info">Accept Order </a>
                <a href="{{ url('admin/cancel/payment/'.$order->id) }}" class="btn btn-danger">Cancel Order </a>
                @elseif ($order->status == 1)
                <a href="{{ url('admin/done/'.$order->id) }}" class="btn btn-success"> Delivery Done</a>
                @elseif ($order->status == 4)
                <strong class="text-danger text-center">This Order Is  Canceled </strong>
                @else
                <strong class="text-success text-center">This Product Successfully Deliveried </strong>
                @endif

            </div>
        </div>

@endsection

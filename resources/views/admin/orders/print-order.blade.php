@extends('admin.print')

@section('content')

    <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
            <h6 class="m-0 font-weight-bold card-body-title "> Order Details </h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">

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

            </div>
        </div>


@endsection

@push('print')
<script>
    window.print();
</script>
@endpush


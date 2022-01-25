@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Product Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="m-0 font-weight-bold card-body-title ">{{ $title }}</h6>
        <div class="ml-auto">
            <a href="{{ url(route('product.create')) }}"class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add new Product</span>
            </a>
        </div>

        <div class="card-body">

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Product Name</th>
                <th class="wd-15p">image</th>
                <th class="wd-15p">Product Code</th>
                <th class="wd-15p">Category Name</th>
                <th class="wd-15p">Price</th>
                <th class="wd-20p">Status</th>
                <th class="wd-10p">Created_at</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($products as $product)
                <tr class="row1" data-id={{ $product->id }}>
                    <td>{{ $product->id }}</td>
                    <td>
                        <a href="{{ url(route('product.show', $product->id)) }}" title="show">{{ $product->product_name }}
                     </a></td>
                     <td>
                @if(!empty($product->image))
             <img src="{{ asset('/files/products/'.$product->image) }}" style="width:50px;height:50px;" />
                @endif
                    </td>
                    <td>{{ $product->product_code }} </td>
                    <td><a href="{{ route('category.index', ['category_id' => $product->category_id]) }}">{{ $product->category->name }}</a></td>
                    <td>
                        @if (!empty($product->price))
                        {{ $product->price }}
                        @else
                        No Price
                        @endif
                       </td>

        <td>
            @if ($product->status == 1)

            <span class="badge badge-success" style="padding: 10px;font-size: 14px;">Active</span>
            @else
             <span class="badge badge-danger" style="padding: 10px;font-size: 14px;">Inactive</span>
            @endif
        </td>
                    <td>{{ $product->created_at->format('d-m-Y h:i a') }}</td>
                    <td>
                        <a href="{{ url(route('product.edit', $product->id)) }}" class="btn btn-sm btn-success" title="edit"><i class="fa fa-edit"></i></a>
                        {!! Form::open(['route'=>['product.destroy',$product->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-sm btn-danger" data-name="{{ $product->name }}" type="submit" title="delete"><i class="fa fa-trash"></i></button>
                         {!! Form::close() !!}

                        @if($product->status==1)

                        <a href="{{ URL::to('admin/product/inactive/'.$product->id) }}" class="btn btn-sm btn-danger" title="Inactive"><i class="fa fa-thumbs-down"></i></a>
                        @else
                      <a href="{{ URL::to('admin/product/active/'.$product->id) }}" class="btn btn-sm btn-info" title="active"><i class="fa fa-thumbs-up"></i></a>
                        @endif
                    </td>
                </tr>


                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->


        </div>

        @push('script')
        <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
        <script type="text/javascript">

           $(function () {
            $("#datatable1").DataTable();

            $( "#tablecontents" ).sortable({
              items: "tr",
              cursor: 'move',
              opacity: 0.6,
              update: function() {
                  sendOrderToServer();
              }
            });

            function sendOrderToServer() {

              var order = [];
              $('tr.row1').each(function(index,element) {
                order.push({
                  id: $(this).attr('data-id'),
                  position: index+1
                });
              });

              $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('product/reorder') }}",
                data: {
                  order:order,
                  _token: '{{csrf_token()}}'
                },
                success: function(response) {
                    if (response.status == "success") {
                      console.log(response);
                    } else {
                      console.log(response);
                    }
                }
              });

            }
          });


        </script>
        @endpush
@endsection

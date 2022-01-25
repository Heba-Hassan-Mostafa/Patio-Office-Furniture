@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Coupon Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="m-0 font-weight-bold card-body-title ">{{ $title }}</h6>
        <div class="ml-auto">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#modaldemo3">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add new Coupon</span>
            </a>
        </div>

   <div class="card-body">

       <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Coupon</th>
                <th class="wd-20p">Discount</th>
                <th class="wd-10p">Created_at</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($coupons as $coupon)
                <tr class="row1" data-id={{ $coupon->id }}>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->coupon }}</td>
                    <td>{{ $coupon->discount }} %</td>
                    <td>{{ $coupon->created_at->format('d-m-Y h:i a') }}</td>
                    <td>
                        <a href="{{ url(route('coupon.edit', $coupon->id)) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        {!! Form::open(['route'=>['coupon.destroy',$coupon->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-danger" data-name="{{ $coupon->name }}" type="submit"><i class="fa fa-trash"></i></button>
                         {!! Form::close() !!}
                    </td>
                </tr>


                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->

   </div>
@include('admin.coupon.model')



@endsection

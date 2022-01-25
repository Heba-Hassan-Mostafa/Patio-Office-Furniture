@extends('admin.app')

@section('content')

@php
$date = date('d-m-y');
$today = DB::table('orders')->where('date',$date)->get();
$month = date('F');
$month = DB::table('orders')->where('month',$month)->get();
$year = date('Y');
$year = DB::table('orders')->where('year',$year)->get();
$delivery = DB::table('orders')->where('date',$date)->where('status',3)->get();
 $product = DB::table('products')->get();
 $brand = DB::table('client_brands')->get();
 $client = DB::table('users')->get();
 $comment = DB::table('comments')->get();

@endphp
<nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('admin.patio') }}">Patio</a>
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>

      <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-sm-6 col-xl-3">
              <div class="card pd-20 bg-primary">
                <div class="d-flex justify-content-between align-items-center mg-b-10">
                  <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><b>Today's Orders</b></h6>
                  <a href="" class="tx-white-8 hover-white">
                      {{-- <i class="icon ion-android-more-horizontal"></i> --}}
                    </a>
                </div><!-- card-header -->
                <div class="d-flex align-items-center justify-content-between">
                  {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
                  <img src="{{ asset('frontend/images/calendar.png') }}" style="width: 60px; height:60px;">
                  <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ $today->count() }} Order</h3>
                </div><!-- card-body -->

              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="card pd-20 bg-info">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><b>This Month's Orders</b></h6>
                <a href="" class="tx-white-8 hover-white">
                    {{-- <i class="icon ion-android-more-horizontal"></i> --}}
                </a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
                <img src="{{ asset('frontend/images/calendar2.png') }}" style="width: 60px; height:60px;">

                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ $month->count() }} Order</h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><b>This Year's Orders</b></h6>
                <a href="" class="tx-white-8 hover-white">
                    {{-- <i class="icon ion-android-more-horizontal"></i> --}}
                </a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
                <img src="{{ asset('frontend/images/calendar3.png') }}" style="width: 60px; height:60px;">

                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ $year->count() }} order</h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-sl-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><b>Today Deliveried</b></h6>
                <a href="" class="tx-white-8 hover-white">
                    {{-- <i class="icon ion-android-more-horizontal"></i> --}}
                </a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
                <img src="{{ asset('frontend/images/delivery-truck.png') }}" style="width: 60px; height:60px;">

                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ $delivery->count() }} Order</h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->



        <br><br>


        <div class="row row-sm">
            <div class="col-sm-6 col-xl-3">
              <div class="card pd-20 bg-primary">
                <div class="d-flex justify-content-between align-items-center mg-b-10">
                  <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><b>Products</b></h6>
                  <a href="" class="tx-white-8 hover-white">
                      {{-- <i class="icon ion-android-more-horizontal"></i> --}}
                    </a>
                </div><!-- card-header -->
                <div class="d-flex align-items-center justify-content-between">
                  {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
                  <img src="{{ asset('frontend/images/office-chair.png') }}" style="width: 60px; height:60px;">

                  <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ $product->count() }} Product</h3>
                </div><!-- card-body -->

              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="card pd-20 bg-info">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><b>Client Brands</b></h6>
                <a href="" class="tx-white-8 hover-white">
                    {{-- <i class="icon ion-android-more-horizontal"></i> --}}
                </a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
                <img src="{{ asset('frontend/images/brand2.png') }}" style="width: 60px; height:60px;">

                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ $brand->count() }} Brand</h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-purple">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><b>Clients</b></h6>
                <a href="" class="tx-white-8 hover-white">
                    {{-- <i class="icon ion-android-more-horizontal"></i> --}}
                </a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
                <img src="{{ asset('frontend/images/group.png') }}" style="width: 60px; height:60px;">

                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ $client->count() }} Client</h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="card pd-20 bg-sl-primary">
              <div class="d-flex justify-content-between align-items-center mg-b-10">
                <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"><b>Client Comments</b></h6>
                <a href="" class="tx-white-8 hover-white">
                    {{-- <i class="icon ion-android-more-horizontal"></i> --}}
                </a>
              </div><!-- card-header -->
              <div class="d-flex align-items-center justify-content-between">
                {{-- <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span> --}}
                <img src="{{ asset('frontend/images/comment.png') }}" style="width: 60px; height:60px;">

                <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ $comment->count() }} Comment</h3>
              </div><!-- card-body -->
              <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
                <div>
                  <span class="tx-11 tx-white-6"></span>
                  <h6 class="tx-white mg-b-0"></h6>
                </div>
              </div><!-- -->
            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->



      </div><!-- sl-pagebody -->
@endsection

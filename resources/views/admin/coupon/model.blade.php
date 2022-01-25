  <!-- LARGE MODAL -->
  <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Category</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pd-20">

            {!! Form::open(
                ['action' => 'BackendController\CouponController@store',
                 'method' => 'post'])
                 !!}
                <div class="row">
                    <div class="col-10">
                        <div class="form-group">
                            {!! Form::label('coupon', 'Coupon') !!}
                            {!! Form::text('coupon', old('coupon'), ['class' => 'form-control']) !!}
                            @error('coupon')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                      <div class="col-10">
                        <div class="form-group">
                            {!! Form::label('discount', 'Discount') !!}
                           <div style="display: flex">
                            {!! Form::text('discount', old('discount'), ['class' => 'form-control','style'=>'width: 95%!important;']) !!}
                            <span style="padding: 3px; font-weight: bold;font-size: 20px; color: red;">%</span>
                           </div>
                            @error('discount')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

        </div><!-- modal-body -->
        <div class="modal-footer form-group pt-4">
            {!! Form::submit('Save', ['class' => 'btn btn-info pd-x-20']) !!}
            {!! Form::button('Close', ['class' => 'btn btn-secondary pd-x-20',"data-dismiss"=>"modal"]) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div><!-- modal-dialog -->
  </div><!-- modal -->

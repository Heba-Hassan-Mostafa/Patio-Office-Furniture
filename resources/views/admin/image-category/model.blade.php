  <!-- LARGE MODAL -->
  <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Image Category</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pd-20">

            {!! Form::open(
                ['action' => 'BackendController\ImageCategoryController@store',
                 'method' => 'post',
                 'files'=>true ,
                'enctype' =>'multipart/form-data'])
                 !!}
                <div class="row">
                    <div class="col-10">
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-10">
                        <div class="form-group">
                            {!! Form::label('image', 'Image') !!}
                            {!! Form::file('image', ['class' => 'form-control']) !!}
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>


                    <div class="col-10">
                        {!! Form::label('status', 'status') !!}
                        {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status'), ['class' => 'form-control']) !!}
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
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

@extends('admin.app')

@section('content')

    <div class="sl-pagebody">
        <div class="sl-page-title">
          <h5>Settings</h5>
        </div><!-- sl-page-title -->

    <!-- /.card-header -->
  <div class="card pd-20 pd-sm-40">
    <h6 class="m-0 font-weight-bold card-body-title "></h6>
    <div class="card-body">
    {!! Form::model($model,[
                    'action' => ['BackendController\SettingController@update', $model->id],
                    'method' => 'put',
                    'files'=>true ,
                    'enctype' =>'multipart/form-data'
                    ])!!}

    <div class="form-group">
      {!! Form::label('siteName','Site Name') !!}
      {!! Form::text('siteName',$model->siteName,['class'=>'form-control']) !!}
    </div>

   

    <div class="form-group">
      {!! Form::label('gmail','Gmail') !!}
      {!! Form::email('gmail',$model->gmail,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('phone_one','Phone One') !!}
        {!! Form::text('phone_one',$model->phone_one,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('phone_two','Phone Two') !!}
        {!! Form::text('phone_two',$model->phone_two,['class'=>'form-control']) !!}
      </div>
    <div class="form-group">
        {!! Form::label('facebook','Facebook') !!}
        {!! Form::url('facebook',$model->facebook,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('twitter','Twitter') !!}
        {!! Form::url('twitter',$model->twitter,['class'=>'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('youtube','Youtube') !!}
        {!! Form::url('youtube',$model->youtube,['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('instagram','Instagram') !!}
        {!! Form::url('instagram',$model->instagram,['class'=>'form-control']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('address','Address') !!}
        {!! Form::text('address',$model->address,['class'=>'form-control']) !!}
      </div>



    <div class="form-group">
        <label class="form-control-label">Logo</label>
      <label class="custom-file">
      {!! Form::file('logo',['class'=>'custom-file-input' ,'id'=>"file" ,'onchange'=>"readURL(this);"]) !!}
      @if(!empty(setting()->logo))
      <img src="{{ asset('/files/setting/'.setting()->logo) }}" style="max-width: 10%;
      margin-top: 10px;" />
     @endif
     <span class="custom-file-control"></span>
     <img src="" id="one">
      </label>
    </div>
    <br><br>

        <div class="form-group">
            <label class="form-control-label">Icon</label>
          <label class="custom-file">
          {!! Form::file('icon',['class'=>'custom-file-input' ,'id'=>"file" ,'onchange'=>"readURL2(this);"]) !!}
          @if(!empty(setting()->icon))
          <img src="{{ asset('/files/setting/'.setting()->icon) }}" style="max-width: 3%;
          margin-top: 10px;" />
         @endif
         <span class="custom-file-control"></span>
         <img src="" id="two">
          </label>
        </div>
    <br><br>

    <div class="form-group">
      {!! Form::label('about_patio','About Patio') !!}
      {!! Form::textarea('about_patio',$model->about_patio,['class'=>'form-control'  ,'id'=>'ckeditor']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('keywords','Keywords') !!}
      {!! Form::text('keywords',$model->keywords,['class'=>'form-control ']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('description','Description') !!}
      {!! Form::textarea('description',$model->description,['class'=>'form-control ']) !!}
    </div>
     <div class="form-group">
      {!! Form::label('status','Status') !!}
      {!! Form::select('status',['open'=>'Open','close'=>'Close'],$model->status,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('message_maintenance','Message Maintenance') !!}
      {!! Form::textarea('message_maintenance',$model->message_maintenance,['class'=>'form-control']) !!}
    </div>
    {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
  <!-- /.box-body -->

</div>
    </div>

{{-- load image --}}

<script type="text/javascript">

    function readURL(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#one')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

<script type="text/javascript">
    function readURL2(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#two')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
@push('ckeditor')

<script src="{{ asset('admin/lib/texteditor/ckeditor/ckeditor.js') }}"></script>
<script>
 CKEDITOR.replace('ckeditor');
</script>
@endpush

    @endsection

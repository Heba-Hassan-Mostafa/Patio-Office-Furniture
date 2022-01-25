@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Video Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="m-0 font-weight-bold card-body-title ">{{ $title }}</h6>
        <div class="ml-auto">
            <a href="{{ url(route('video.create')) }}"class="btn btn-primary">                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add new Video</span>
            </a>
        </div>

        <div class="card-body">

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Name</th>
                <th class="wd-20p">Status</th>
                <th class="wd-10p">Created_at</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($videos as $video)
                <tr class="row1" data-id={{ $video->id }}>
                    <td>{{ $video->id }}</td>
                    <td>{{ $video->video_name }}</td>
                    <td>
                        @if ($video->status == 1)

                        <span class="badge badge-success" style="padding: 10px;font-size: 14px;">Active</span>
                        @else
                         <span class="badge badge-danger" style="padding: 10px;font-size: 14px;">Inactive</span>
                        @endif
                    </td>

                    <td>{{ $video->created_at->format('d-m-Y h:i a') }}</td>
                    <td>
                        <a href="{{ url(route('video.edit', $video->id)) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                        {!! Form::open(['route'=>['video.destroy',$video->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-danger" data-name="{{ $video->name }}" type="submit"><i class="fa fa-trash"></i></button>
                           {!! Form::close() !!}
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
        url: "{{ route('video/reorder') }}",
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

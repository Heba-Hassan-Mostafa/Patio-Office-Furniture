@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Comments Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="m-0 font-weight-bold card-body-title ">{{ $title }}</h6>


   <div class="card-body">

       <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Name</th>
                <th class="wd-15p">Email</th>
                <th class="wd-15p">Status</th>
                <th class="wd-15p">comment</th>
                <th class="wd-10p">Created_at</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($comments as $comment)
                <tr class="row1" data-id={{ $comment->id }}>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->name }}</td>
                    <td>{{ $comment->email }}</td>
                    <td style="text-align:center">

                        <div class="custom-control custom-switch" style="margin: auto">
                            <input type="checkbox" class="custom-control-input" id="{{ $comment->id }}"  data-id="{{  $comment->id }}" {{ $comment->status == true ? 'checked' : '' }}>
                            <label class="custom-control-label" for="{{ $comment->id }}"></label>
                          </div>

                    </td>
                    <td>{{ str_limit( $comment->comment , $limit = 40) }}</td>
                    <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffforhumans() }}</td>
                    <td>
                        {!! Form::open(['route'=>['comments.destroy',$comment->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-danger" data-name="{{ $comment->name }}" type="submit"><i class="fa fa-trash"></i></button>
                         {!! Form::close() !!}

                         <a href="" class="btn btn-success" data-toggle="modal" data-target="#modaldemo3-{{ $comment->id }}">
                                <i class="fa fa-eye"></i>
                            <span class="text"></span>
                        </a>
                    </td>
                </tr>


                  <!-- LARGE MODAL -->
  <div id="modaldemo3-{{ $comment->id }}" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Show Comment</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pd-20">
                <div class="row">
                    <div class="col-10">
                       {{ $comment->comment }}
                    </div>
                </div>

        </div><!-- modal-body -->

      </div>
    </div><!-- modal-dialog -->
  </div><!-- modal -->

                @endforeach
            </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->

   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

   <script>

   $(document).ready(function(){
    $('.custom-control-input').on('change',function() {

        var status = $(this).prop('checked') == true ? 1 : 0;

        var id = $(this).data('id');
        console.log(status);

        $.ajax({

            type: "GET",

            dataType: "json",

            url: '/admin/comments/change',

            data: {'status': status, 'id': id},

            success: function(data){

            console.log(data.success)

            }

        });

        });
        });

  </script>


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
        url: "{{ route('comments/reorder') }}",
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


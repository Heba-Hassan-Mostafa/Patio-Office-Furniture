@extends('admin.app')

@section('content')


    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Contact-US Table</h5>
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
                <th class="wd-15p">Message</th>
                <th class="wd-10p">Created_at</th>
                <th class="wd-25p">Action</th>
              </tr>
            </thead>
            <tbody id="tablecontents">
                @foreach ($contacts as $contact)
                <tr class="row1" data-id={{ $contact->id }}>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ str_limit( $contact->message , $limit = 40) }}</td>
                    <td>{{ \Carbon\Carbon::parse($contact->created_at)->diffforhumans() }}</td>
                    <td>
                        {!! Form::open(['route'=>['contacts.destroy',$contact->id],'method'=>'delete','style'=>'display:inline-block']) !!}
                        <button id="delete" class="btn btn-danger" data-name="{{ $contact->name }}" type="submit"><i class="fa fa-trash"></i></button>
                         {!! Form::close() !!}

                         <a href="" class="btn btn-success" data-toggle="modal" data-target="#modaldemo3-{{ $contact->id }}">
                                <i class="fa fa-eye"></i>
                            <span class="text"></span>
                        </a>
                    </td>
                </tr>


                  <!-- LARGE MODAL -->
  <div id="modaldemo3-{{ $contact->id }}" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Show Message</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pd-20">
                <div class="row">
                    <div class="col-10">
                       {{ $contact->message }}
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




@endsection


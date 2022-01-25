

{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
<script src="{{ asset("admin/lib/jquery/jquery.js") }}"></script>
{{-- <script src="{{ asset("admin/lib/popper.js/popper.js") }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="{{ asset("admin/lib/bootstrap/bootstrap.js")}}"></script>
<script src="{{ asset("admin/lib/jquery-ui/jquery-ui.js")}}"></script>
<script src="{{ asset("admin/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js")}}"></script>
<script src="{{ asset("admin//lib/highlightjs/highlight.pack.js")}}"></script>
<script src="{{ asset('admin/lib/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/lib/datatables-responsive/dataTables.responsive.js') }}"></script>
<script src="{{ asset('admin/lib/select2/js/select2.min.js') }}"></script>

{{-- <script src="{{ asset('admin/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admin/lib/d3/d3.js') }}"></script>
    <script src="{{ asset('admin/lib/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('admin/lib/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('admin/lib/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('admin/lib/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('admin/lib/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('admin/lib/flot-spline/jquery.flot.spline.js') }}"></script> --}}



<script>
    $(function(){
      'use strict';
      $('#datatable1').DataTable({
        responsive: true,
        bSort: false,
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          lengthMenu: '_MENU_ items/page',
        }


      });

      // Select2
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    });
  </script>



<script src="{{ asset("admin/lib/bootstrap-fileinput/js/plugins/piexif.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/lib/bootstrap-fileinput/js/plugins/sortable.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/lib/bootstrap-fileinput/js/fileinput.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("admin/lib/bootstrap-fileinput/themes/fa/theme.js") }}" type="text/javascript"></script>

<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script src="{{ asset('admin/js/starlight.js') }}"></script>
{{-- <script src="{{ asset('admin/js/ResizeSensor.js') }}"></script>
<script src="{{ asset('admin/js/dashboard.js') }}"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
@if (Session::has('message'))
var type = "{{ Session::get('alert-type','info') }}"
switch(type)
{
    case 'info':
    toastr.info("{{ Session::get('message') }}")
    break;

    case 'success':
    toastr.success("{{ Session::get('message') }}")
    break;

    case 'warning':
    toastr.warning("{{ Session::get('message') }}")
    break;

    case 'error':
    toastr.error("{{ Session::get('message') }}")
    break;

}
@endif
</script>



<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var form =  $(this).closest("form");
        var name = $(this).data("name");
           swal({
             title: "Are you Want to delete?",
             text: "Once Delete, This will be Permanently Delete!",
             icon: "warning",
             buttons: true,
             dangerMode: true,
           })
           .then((willDelete) => {
             if (willDelete) {
                form.submit();
             } else {
               swal("Safe Data!");
             }
           });
       });
</script>



@stack('select')
@stack('script')
@stack('ckeditor')
@stack('fileinput')
@stack('print')











































































  {{-- <!-- Footer -->
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a>
    </div>
</div>
</div>
</div> --}}
<!-- Scripts -->
{{-- <script src="{{ asset('js/app.js') }}"></script>

 <!-- Core plugin JavaScript-->
 <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/select2/js/select2.min.js') }}"></script> --}}

 <!-- Page level plugins -->
 {{-- <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

 <!-- Page level custom scripts -->
 <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
 <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script> --}}
 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script src="{{ asset('admin/js/custom.js') }}"></script>
<script>
    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type)
    {
        case 'info':
        toastr.info("{{ Session::get('message') }}")
        break;

        case 'success':
        toastr.success("{{ Session::get('message') }}")
        break;

        case 'warning':
        toastr.warning("{{ Session::get('message') }}")
        break;

        case 'error':
        toastr.error("{{ Session::get('message') }}")
        break;

    }
    @endif
</script>
 --}}










<![endif]-->
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('admin-panel/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/extra-libs/sparkline/sparkline.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('admin-panel/dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('admin-panel/dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('admin-panel/dist/js/custom.min.js')}}"></script>
<script src="{{ asset('js/sweetalert.min.js') }} "></script>
<script src="{{asset('admin-panel/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>

<script>
        $(document).ready(function() {

            @if (Session::has('error'))
            swal(" {{ session()->get('error') }}", "You clicked the button!", "error")
            @elseif(Session::has('success'))
               swal(" {{ session()->get('success') }}", "You clicked the button!", "success")
                             
            @endif

            @if(Session::has('"statusCode"=>200'))
           swal(" {{ session()->get('success') }}", "You clicked the button!", "success")
          @endif
        });

                
    </script>


<script src="{{asset('admin-panel/assets/libs/moment/min/moment.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>

{{--poxi add gareko--}}

<script src="{{asset('admin-panel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/custom.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/pages/calendar/cal-init.js')}}"></script>


    <script src="{{asset('admin-panel/dist/js/jquery.ui.touch-punch-improved.js')}}"></script>
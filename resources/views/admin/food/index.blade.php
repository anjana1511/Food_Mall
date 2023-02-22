@extends('admin.layout.master')

@section('content')

<div class="page-wrapper">

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Manage Food</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Food</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>

<footer class="footer text-center">
    All Rights Reserved by Khoz Informatics Pvt. Ltd. Designed and Developed by <a href="https://khozinfo.com/">Khozinfo</a>.
</footer>

</div>

@endsection

@section('js')

<script src="{{asset('admin-panel/assets/libs/flot/excanvas.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/pages/chart/chart-page-init.js')}}"></script>

<script src="{{asset('admin-panel/assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/custom.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/moment/min/moment.min.js')}}"></script>
<script src="{{asset('admin-panel/assets/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{asset('admin-panel/dist/js/pages/calendar/cal-init.js')}}"></script>

@endsection

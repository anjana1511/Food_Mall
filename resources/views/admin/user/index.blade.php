@extends('admin.layout.master')

@section('content')

    <div id="main-wrapper">

        @include('admin.includes.sidebar')

        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Admin Manager</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user')}}">User</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form action="{{route('user.search')}}" method="GET" class="form-horizontal">
                                <div class="card-body">
                                    <h4 class="card-title">Search</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Search by employee name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="search" class="form-control" id="fname" placeholder="Employee name">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-success">Search</button>
                                        <a href="{{route('user')}}" class="btn btn-md btn-danger">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-b-0">Admin</h5>
                            </div>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Username</th>
                                    <th>Image</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th colspan="2">Update/Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <td>{{$user->username}}</td>
                                        <td><img src="{{ asset('image/users/').'/'. $user->image }}" width="80px" height="80px" alt="Image"> </td>
                                        <td>@if($user->role == 0) 
                                                 Cashear
                                            @elseif($user->role == 1)
                                                 Admin
                                            @elseif($user->role == 2)
                                                  User
                                            @endif           
                                        </td>
                                        <td>{{$user->email}}</td>
                                       
                                        <td>
                                            <button type="button"
                                                    username="{{$user->username}}"
                                                    role="{{$user->role}}"
                                                    email="{{$user->email}}"
                                                    salary="{{$user->salary}}"
                                                    phone="{{$user->phone}}"
                                                    address="{{$user->address}}"
                                                    gender="{{$user->gender}}"
                                                    dob="{{$user->dob}}"
                                                    join_date="{{$user->join_date}}"
                                                    job_type="{{$user->job_type}}"
                                                    city="{{$user->city}}"
                                                    age="{{$user->age}}"
                                                    class="view-data btn btn-sm btn-success">View</button>
                                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-sm btn-dark">Edit</a>
                                            
                                            <button type="button" class="btn btn-sm btn-danger delete" data-id="{{ $user->id }}">Delete</button>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            {{ $users->links('vendor.pagination.simple-bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>

                <script>
                    $('.view-data').click(function(){
                        var username=$(this).attr('username');
                        var role=$(this).attr('role');
                        var email=$(this).attr('email');
                        var salary=$(this).attr('salary');
                        var phone=$(this).attr('phone');
                        var address=$(this).attr('address');
                        var gender=$(this).attr('gender');
                        var dob=$(this).attr('dob');
                        var join_date=$(this).attr('join_date');
                        var job_type=$(this).attr('job_type');
                        var city=$(this).attr('city');
                        var age=$(this).attr('age');
                        $('#username').text(username);
                        $('#role').text(role);
                        $('#email').text(email);
                        $('#salary').text(salary);
                        $('#phone').text(phone);
                        $('#address').text(address);
                        $('#gender').text(gender);
                        $('#dob').text(dob);
                        $('#join_date').text(join_date);
                        $('#job_type').text(job_type);
                        $('#city').text(city);
                        $('#age').text(age);
                        $('#show-data').modal();
                    })
                </script>


                <div id="show-data" class="modal fade" id="view-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p id="username"></p>
                                <p id="role"></p>
                                <p id="email"></p>
                                <p id="salary"></p>
                                <p id="phone"></p>
                                <p id="address"></p>
                                <p id="gender"></p>
                                <p id="dob"></p>
                                <p id="join_date"></p>
                                <p id="job_type"></p>
                                <p id="city"></p>
                                <p id="age"></p>
                                <p id="phone"></p>
                            </div>
                        </div>
                    </div>
                </div>

                
                    {{--@endsection--}}

            <footer class="footer text-center">
                All Rights Reserved by Khoz Informatics Pvt. Ltd. Designed and Developed by <a href="https://khozinfo.com/">Khozinfo</a>.
            </footer>
        </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script  type="application/javascript">
   
   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

   $(document).on("click",".delete", function()
{
    
        var id=$(this).data(id);
            swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
        },
            function(isConfirm){
            if (isConfirm) {
                                
                $.ajax({
                url: "{{ route('user.delete') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                success: function(response){
                      console.log(data);
                    swal({title: "Success", text: "State has been deleted!", type: "success"},
                            function(){ 
                                location.reload();
                            }
                        );
                // swal("Deleted!", "Your imaginary file has been deleted.", "success");
              
                }
            });
                
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }

            // location.reload();
        });

});
    </script>




    
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

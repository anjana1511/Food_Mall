@extends('admin.layout.master')

@section('content')

<div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Reservation</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reservation</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- Container fluid  -->
 <!-- ============================================================== -->
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">All Reservation List</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            <th>S/N</th>
                                            <th>No of Guests</th>
                                            <th>Customer Name</th>
                                            <th>Phone</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Suggestions</th>
                                            <th colspan="2">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $item)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{ $item->no_of_guest }}</td>
                                                <td>{{ $item->cust_name }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ $item->date_res }}</td>
                                                <td>{{ $item->time }}</td>
                                                <td>{{ $item->suggestions }}</td>
                                                <td>
                                                 <button type="button" class="btn btn-sm btn-danger delete" data-id="{{ $item->reserve_id }}">Delete</button>
                                                
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{ $data->links('vendor.pagination.simple-bootstrap-4') }}
                                </div>

                            </div>
                        </div>                          
        </div><!-- end col-12 -->
    </div><!-- End row -->        
     </div><!-- End Container fluid -->
</div> <!-- end page wapper  -->

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
                url: "{{ route('reservation.delete') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                success: function(response){
                    //  console.log(data);
                    swal({title: "Success", text: "Food has been deleted!", type: "success"},
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
@endsection

@extends('cashier.layout.master')

@section('content')

<div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Manage Customer</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">customer</li>
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
        <div class="col-md-6">
                        <div class="card">
                           <form class="form-horizontal" method="post" action="{{ route('customer.store') }}" enctype="multipart/form-data">
                            @csrf
                               <div class="card-body">
                                    <h4 class="card-title">Add New Customer</h4>
                                    <div class="form-group row">
                                        <label for="cat_name" class="col-sm-3 text-right control-label col-form-label">Category Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="cust_name" name="cust_name" placeholder="Customer Name Here">
                                            @if ($errors->has('cust_name'))
                                                <span class="text-danger">{{ $errors->first('cust_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Mo.No</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="phone" name="phone">
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- End Card -->
                        
        </div> <!-- End md-6 -->
        <div class="col-md-6">
                        <div class="card">
                            <form class="form-horizontal" action="{{route('customer.search')}}" method="GET">
                                <div class="card-body">
                                    <h4 class="card-title">Search</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Customer Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="search" placeholder="Customer Name Here">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                    <button type="submit" class="btn btn-success">Search</button>
                                        <a href="{{route('customer')}}" class="btn btn-md btn-danger">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- End Card -->
                        
        </div> <!-- End md-6 -->
    </div> <!-- End row -->
    <div class="row">
        <div class="col-12">
        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">All Customers</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                 <th colspan="2">Update/Delete</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($customer as $item)
                                            <tr>
                                                <td>{{ $item->cust_name }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>
                                                <button type="button" class="btn btn-sm btn-dark update" data-toggle="modal" data-id="{{ $item->cust_id }}">
                                                  Edit
                                                 </button>

                                                 <button type="button" class="btn btn-sm btn-danger delete" data-id="{{ $item->cust_id }}">Delete</button>
                                                
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{ $customer->links('vendor.pagination.simple-bootstrap-4') }}
                                </div>

                            </div>
                        </div>                          
        </div><!-- end col-12 -->
    </div><!-- End row -->

                                <!-- Modal -->
                                <div id="dataModal" class="modal fade">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('customer.update')}}" method="post" enctype="multipart/form-data">
                                             {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="cust_name" class="col-sm-3 text-right control-label col-form-label">Customer Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" id="edit_id" name="edit_id">
                                                        <input type="text" class="form-control" id="ecust_name" name="ecust_name" placeholder="Customer Name Here">
                                                        @if ($errors->has('ecust_name'))
                                                        <span class="text-danger">{{ $errors->first('ecust_name') }}</span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                     <label for="ephone" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                                     <div class="col-sm-9">
                                                        <textarea class="form-control" id="ephone" name="ephone" placeholder="Mo No Hear"></textarea>
                                                        @if ($errors->has('ephone'))
                                                            <span class="text-danger">{{ $errors->first('ephone') }}</span>
                                                        @endif 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                         </form>
                                        </div>
                                    </div>
                                </div>


</div> <!-- End Container fluid  -->

<footer class="footer text-center">
    All Rights Reserved by Khoz Informatics Pvt. Ltd. Designed and Developed by <a href="https://khozinfo.com/">Khozinfo</a>.
</footer>

</div><!-- End Page wrapper  -->

@endsection

@section('js')
<script  type="application/javascript">
   
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
        $(document).on("click", ".update" , function() {
    var edit_id = $(this).data('id');

  $.ajax({
    url: "{{ route('customer.edit') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(data){
        console.log(data);

        $('#edit_id').val(data.custdata.cust_id);
        $('#ecust_name').val(data.custdata.cust_name);  
        $('#ephone').html(data.custdata.phone);
        $('#dataModal').modal('show'); 
   
    }
  });

});

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
                url: "{{ route('customer.delete') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                success: function(response){
                    //  console.log(data);
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
    
@endsection

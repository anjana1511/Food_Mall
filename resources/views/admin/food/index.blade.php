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
<!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
                        <div class="card">
                           <form class="form-horizontal" method="post" action="{{ route('food.store') }}" enctype="multipart/form-data">
                            @csrf
                               <div class="card-body">
                                    <h4 class="card-title">Add New Food</h4>
                                    <div class="form-group row">
                                        <label for="food_name" class="col-sm-3 text-right control-label col-form-label">Food Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="food_name" name="food_name" placeholder="Food Name Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cat_name" class="col-sm-3 text-right control-label col-form-label">Category</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="cat_name" name="cat_name">
                                            @foreach($category as $cat)
                                                  <option value="{{ $cat->cat_id }}">{{ $cat->cat_name }}</option>
                                                  @endforeach
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-3 text-right control-label col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="price" name="price" placeholder="Food Price Here">
                                        </div>
                                    </div>                                
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="food_description" name="food_description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="iamge" class="col-sm-3 text-right control-label col-form-label">Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" id="image" name="image" placeholder="Category Image Here">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                             <select class="form-control" id="status" name="status">
                                                 <option value="Available">Available</option>
                                                 <option value="Not Available">Not Available</option>
                                             </select>
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
                            <form class="form-horizontal" action="{{route('food.search')}}" method="GET">
                                <div class="card-body">
                                    <h4 class="card-title">Search</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Food Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="search" placeholder="Food Name Here">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                    <button type="submit" class="btn btn-success">Search</button>
                                        <a href="{{route('category')}}" class="btn btn-md btn-danger">Clear</a>
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
                                <h5 class="card-title">All Foods</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                 <th colspan="2">Update/Delete</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($food as $item)
                                            <tr>
                                                <td>{{ $item->food_name }}</td>
                                                <td>{{ $item->food_description }}</td>
                                                <td><img src="{{ asset('image/Food/').'/'. $item->image }}" width="80px" height="80px" alt="Image"> </td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                <button type="button" class="btn btn-sm btn-dark update" data-toggle="modal" data-id="{{ $item->food_id }}">
                                                  Edit
                                                 </button>

                                                 <button type="button" class="btn btn-sm btn-danger delete" data-id="{{ $item->food_id }}">Delete</button>
                                                
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{ $food->links('vendor.pagination.simple-bootstrap-4') }}
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
                                                <h5 class="modal-title" id="exampleModalLabel">Update Food</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('food.update')}}" method="post" enctype="multipart/form-data">
                                             {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="cat_name" class="col-sm-3 text-right control-label col-form-label">Food Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" id="edit_id" name="edit_id">
                                                        <input type="text" class="form-control" id="efood_name" name="efood_name" placeholder="Food Name Here">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="cat_name" class="col-sm-3 text-right control-label col-form-label">Category</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="ecat_name" name="ecat_name">
                                                        @foreach($category as $cat)
                                                            <option value="{{ $cat->cat_id }}">{{ $cat->cat_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>  
                                                <div class="form-group row">
                                                    <label for="price" class="col-sm-3 text-right control-label col-form-label">Price</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" id="eprice" name="eprice" placeholder="Food Price Here">
                                                    </div>
                                                </div>                              
                                                <div class="form-group row">
                                                     <label for="ecat_description" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                                     <div class="col-sm-9">
                                                        <textarea class="form-control" id="efood_description" name="efood_description" placeholder="Description"></textarea>
                                                     </div>
                                                </div>
                                                <div class="form-group row">
                                                     <label for="ecat_image" class="col-sm-3 text-right control-label col-form-label">Image</label>
                                                     <div class="col-sm-9">
                                                     <img id="efood_photo" src="" width="80px" height="80px" alt="Image">
                                                     <input type="file" class="form-control" id="eimage" name="eimage" placeholder="Food Image Here">
                                                     </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="estatus" id="estatus">
                                                            <option value="Available">Available</option>
                                                            <option value="Not Available">Not Available</option>
                                                        </select>
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
    </div>
@endsection

@section('js')
    @include('admin.includes.scripts')
<script  type="application/javascript">
   
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
        $(document).on("click", ".update" , function() {
    var edit_id = $(this).data('id');

  $.ajax({
    url: "{{ route('food.edit') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(data){
        console.log(data);

        $('#edit_id').val(data.fooddata.food_id);
        $('#efood_name').val(data.fooddata.food_name);  
        $('#eprice').val(data.fooddata.price);
        $('#efood_description').html(data.fooddata.food_description);
        $('#efood_photo').attr("src","{{asset('image/Food/')}}"+'/'+data.fooddata.image);
        // $('#estatus').html(data.catdata.status);
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
                url: "{{ route('food.delete') }}",
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

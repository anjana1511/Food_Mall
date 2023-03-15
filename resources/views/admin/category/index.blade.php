@extends('admin.layout.master')

@section('content')

<div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Manage Category</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                           <form class="form-horizontal" method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                            @csrf
                               <div class="card-body">
                                    <h4 class="card-title">Add New Category</h4>
                                    <div class="form-group row">
                                        <label for="cat_name" class="col-sm-3 text-right control-label col-form-label">Category Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Category Name Here">
                                            @if ($errors->has('cat_name'))
                                                <span class="text-danger">{{ $errors->first('cat_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="cat_description" name="cat_description"></textarea>
                                            @if ($errors->has('cat_description'))
                                                <span class="text-danger">{{ $errors->first('cat_description') }}</span>
                                            @endif
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
                            <form class="form-horizontal" action="{{route('category.search')}}" method="GET">
                                <div class="card-body">
                                    <h4 class="card-title">Search</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Category Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="search" placeholder="Category Name Here">
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
                                <h5 class="card-title">All Categories</h5>
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
                                            @foreach($category as $item)
                                            <tr>
                                                <td>{{ $item->cat_name }}</td>
                                                <td>{{ $item->cat_description }}</td>
                                                <td><img src="{{ asset('image/category/').'/'. $item->image }}" width="80px" height="80px" alt="Image"> </td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                <button type="button" class="btn btn-sm btn-dark update" data-toggle="modal" data-id="{{ $item->cat_id }}">
                                                  Edit
                                                 </button>

                                                 <button type="button" class="btn btn-sm btn-danger delete" data-id="{{ $item->cat_id }}">Delete</button>
                                                
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{ $category->links('vendor.pagination.simple-bootstrap-4') }}
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
                                                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('category.update')}}" method="post" enctype="multipart/form-data">
                                             {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="cat_name" class="col-sm-3 text-right control-label col-form-label">Category Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" id="edit_id" name="edit_id">
                                                        <input type="text" class="form-control" id="ecat_name" name="ecat_name" placeholder="Category Name Here">
                                                        @if ($errors->has('ecat_name'))
                                                        <span class="text-danger">{{ $errors->first('ecat_name') }}</span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                     <label for="ecat_description" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                                     <div class="col-sm-9">
                                                        <textarea class="form-control" id="ecat_description" name="ecat_description" placeholder="Description"></textarea>
                                                        @if ($errors->has('ecat_description'))
                                                            <span class="text-danger">{{ $errors->first('ecat_description') }}</span>
                                                        @endif 
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                     <label for="ecat_image" class="col-sm-3 text-right control-label col-form-label">Image</label>
                                                     <div class="col-sm-9">
                                                     <img id="ecat_photo" src="" width="80px" height="80px" alt="Image">
                                                     <input type="file" class="form-control" id="eimage" name="eimage" placeholder="Category Image Here">
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

@endsection

@section('js')
<script  type="application/javascript">
   
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
        $(document).on("click", ".update" , function() {
    var edit_id = $(this).data('id');

  $.ajax({
    url: "{{ route('category.edit') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(data){
        console.log(data);

        $('#edit_id').val(data.catdata.cat_id);
        $('#ecat_name').val(data.catdata.cat_name);  
        $('#ecat_description').html(data.catdata.cat_description);
        $('#ecat_photo').attr("src","{{asset('image/category/')}}"+'/'+data.catdata.image);
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
                url: "{{ route('category.delete') }}",
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

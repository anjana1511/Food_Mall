@extends('admin.layout.master')

@section('content')

<div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Manage Menu Item</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item" ><a href="{{route('menu')}}">Manu</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manu Item</li>
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
                           <form class="form-horizontal" method="post" action="{{ route('menu.store_item') }}" enctype="multipart/form-data">
                            @csrf
                               <div class="card-body">
                                    <h4 class="card-title">Add New Menu Item</h4>
                                    <div class="form-group row">
                                        <label for="menu_name" class="col-sm-3 text-right control-label col-form-label">Menu Name</label>
                                        <div class="col-sm-9">
                                          <input type="text" id="menu_name" name="menu_name" class="form-control" value="{{ $data->menu_name }}" readonly>
                                          <input type="hidden" id="menu_id" name="menu_name" value="{{ $data->menu_id }}" >
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
                                        <label for="food_name" class="col-sm-3 text-right control-label col-form-label">Food Name</label>
                                        <div class="col-sm-9">
                                        <select id="food_name" name="food_name" class="form-control">
                                          <option value="1">Select</option>
                                        </select>
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
                            <form class="form-horizontal" action="{{route('menu.search')}}" method="GET">
                                <div class="card-body">
                                    <h4 class="card-title">Search</h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Menu Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="search" placeholder="Menu Name Here">
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                    <button type="submit" class="btn btn-success" >Search</button>
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
                                <h5 class="card-title">All Menu Items</h5>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Menu Name</th>
                                                <th>Category</th>
                                                <th>Food</th>
                                                 <th colspan="2">Update/Delete</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($items as $item)
                                            <tr>
                                                <td>{{ $item->menu_name }}</td>
                                                <td>{{ $item->cat_name }}</td>
                                                <td>{{ $item->food_name}} </td>
                                                <td>
                                                <button type="button" class="btn btn-sm btn-dark update" data-toggle="modal" data-id="{{ $item->item_id }}" data-act="item_up">
                                                  Edit
                                                 </button>

                                                 <button type="button" class="btn btn-sm btn-danger delete" data-id="{{ $item->item_id }}">Delete</button>
                                                
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{ $items->links('vendor.pagination.simple-bootstrap-4') }}
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
                                                <h5 class="modal-title" id="exampleModalLabel">Update Menu Item</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('menu.update')}}" method="post" enctype="multipart/form-data">
                                             {{ csrf_field() }}
                                            <div class="modal-body">
                                               <div class="form-group row">
                                                    <label for="menu_name" class="col-sm-3 text-right control-label col-form-label">Menu Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="emenu_name" name="emenu_name" class="form-control" readonly>
                                                        <input type="hidden" id="emenu_id" name="emenu_id">
                                                        <input type="hidden" id="edit_id" name="edit_id">
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
                                                    <label for="food_name" class="col-sm-3 text-right control-label col-form-label">Food Name</label>
                                                    <div class="col-sm-9">
                                                    <select id="food_name" name="food_name" class="form-control">
                                                    <option value="1">Select</option>
                                                    </select>
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="estatus" name="estatus">
                                                            <option value="Available">Available</option>
                                                            <option value="Not Available">Not Available</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="action" value="menu_item">Save changes</button>
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
    var data_act=$(this).data('act');
  $.ajax({
    url: "{{ route('menu.edit') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id,data_act: data_act},
    success: function(data){
        console.log(data);

        $('#emenu_id').val(data.menudata.menu_id);
        $('#edit_id').val(data.menudata.item_id);
        $('#emenu_name').val(data.menudata.menu_name);  
        // $('#estatus').html(data.catdata.status);
        $('#dataModal').modal('show'); 
   
    }
  });

});

jQuery(document).ready(function ()
    {
            jQuery('select[name="cat_name"]').on('change',function(){
               var catID = jQuery(this).val();

               var url = "{{ route('getfood', ":catID") }}";
                url = url.replace(':catID', catID);

               if(catID)
               {
                  jQuery.ajax({
                     url:url,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        
                        jQuery('select[name="food_name"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="food_name"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    
                     }
                  });
               }
               else
               {
                  $('select[name="food_name"]').empty();
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
                url: "{{ route('menu.delete_item') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id,},
                success: function(response){
                    //  console.log(response);
                    swal({title: "Success", text: "Menu Item has been deleted!", type: "success"},
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
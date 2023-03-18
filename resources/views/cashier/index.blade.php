@extends('cashier.layout.master')

@section('content')

    <div class="page-wrapper">

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Dashboard</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
           <div class="row">
                 <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                                <h4 class="card-title">ALL MENU</h4>
                                <form method="post" action="{{ route('add_to_cart') }}">
                                 @csrf
                                 <div class="form-group row">
                                        <div class="col-md-9">
                                            <select class="form-control" id="menu_id" name="menu_id">
                                                @foreach($menu as $data)
                                                    <option value="{{ $data->menu_id }}">{{ $data->menu_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="textbox" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                                        </div>
                                    </div>
                        </div><!-- end card body -->
                        <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        <button type="button" class="btn btn-sm btn-dark update" data-toggle="modal">
                                                  Edit
                                                 </button>
                                    </div>
                                 </form>   
                        </div> <!-- end border-top -->
                </div> <!-- end card -->
              </div> <!-- col-md-6 -->
              <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                                <h4 class="card-title">All Food Category</h4>
                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <select class="form-control" id="cat_id" name="cat_id">
                                                @foreach($all_category as $data1)
                                                    <option value="{{ $data1->cat_id }}">{{ $data1->cat_name }}</option>
                                                @endforeach
                                        </select>
                                    </div>    

                                    <div class="col-md-3">
                                            <input type="textbox" class="form-control" id="qty" name="qty" placeholder="Quantity">
                                   </div>
                                </div>   
                        </div><!-- end card body -->
                        <div class="border-top">
                                    <div class="card-body">
                                       <!-- <button type="submit" class="btn btn-primary">Show All Foods</button> -->
                                    </div>
                                 </form>   
                        </div> <!-- end border-top -->
                </div> <!-- end card -->
                
              </div> <!-- col-md-6 -->              
           </div>
            <div class="row">
            <div class="col-12">
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">All Menu Items
                                <a href="" class="badge badge-pill badge-primary float-right">Go to Cart</a></h4>
                                <div class="table-responsive">
                                    <table id="menu_table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Food Name</th>
                                                <th style="text-align: center">Category</th>
                                                <th style="text-align: center">Price</th>
                                                <th style="text-align: center" colspan="2" id="act">Update/Delete</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                 </div>

                            </div>
                        </div>                          
        </div><!-- end col-12 -->
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('cashier.customer.create')

        </div>

        <footer class="footer text-center">
            All Rights Reserved by Khoz Informatics Pvt. Ltd. Designed and Developed by <a href="https://khozinfo.com/">Khozinfo</a>.
        </footer>

    </div>

@endsection

@section('js')
<script  type="application/javascript">
   
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    jQuery(document).ready(function ()
    {
            jQuery('select[name="menu_id"]').on('change',function(){
                $("#act").hide();

               var menuID = jQuery(this).val();

               var url = "{{ route('getitem', ":menuID") }}";
                url = url.replace(':menuID', menuID);

               if(menuID)
               {
                  jQuery.ajax({
                     url:url,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);

                        var len = 0;
           $('#menu_table tbody').empty(); // Empty <tbody>
           if(data != null){
             len = data.length;
           }
                if(len > 0){

                    for(var i=0; i<len; i++){
                        
                        var food_name = data[i].food_name;
                        var cat_name=data[i].cat_name;
                        var price=data[i].price;
                        var tr_str = "<tr>" +
                        "<td align='center'>" + food_name + "</td>" +
                        "<td align='center'>" + cat_name + "</td>" +
                        "<td align='center'>" + price + "</td>" +
                        "<tr>";
                        $("#menu_table tbody").append(tr_str);
                    }
                    }else if(data != null){
                            var tr_str = "<tr>" +
                            "<td align='center'>1</td>" +
                            "<td align='center'>" + data.food_name + "</td>" + 
                            "<td align='center'>" + data.cat_name + "</td>"+
                            "<td align='center'>" + data.price + "</td>"+
                            
                        "</tr>";
                        $("#menu_table tbody").append(tr_str);
                        }
                    else{
                            var tr_str = "<tr>" +
                                "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";

                            $("#menu_table tbody").append(tr_str);
                        }
                     }
                  });
               }
               else
               {
                var tr_str = "<tr>" +
                                "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";

                            $("#menu_table tbody").append(tr_str);
               }
            });    //end select change method

            //Category Wise food disply

            jQuery('select[name="cat_id"]').on('change',function(){
                $("#act").show();

               var catID = jQuery(this).val();

               var url = "{{ route('show_food', ":catID") }}";
                url = url.replace(':catID', catID);

               if(catID)
               {
                  jQuery.ajax({
                     url:url,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);

                        var len = 0;
           $('#menu_table tbody').empty(); // Empty <tbody>
           if(data != null){
             len = data.length;
           }
                if(len > 0){

                    for(var i=0; i<len; i++){
                        
                        var food_id=data[i].food_id;
                        var food_name = data[i].food_name;
                        var cat_name=data[i].cat_name;
                        var price=data[i].price;
                        var tr_str = "<tr>" +
                        "<td align='center'>" + food_name + "</td>" +
                        "<td align='center'>" + cat_name + "</td>" +
                        "<td align='center'>" + price + "</td>" +
                        "<td align='center'><input type='button' value='Add to cart' class='cart btn btn-info' data-id='"+food_id+"' data-amount='"+price+"'></td>"+
                        "<tr>";
                        $("#menu_table tbody").append(tr_str);
                    }
                    }else if(data != null){
                            var tr_str = "<tr>" +
                            "<td align='center'>1</td>" +
                            "<td align='center'>" + data.food_name + "</td>" + 
                            "<td align='center'>" + data.cat_name + "</td>"+
                            "<td align='center'>" + data.price + "</td>"+
                            "<td align='center'><input type='button' value='Add to cart' class='cart btn btn-info' data-id='"+data.food_id+"' ></td>"+
                            
                        "</tr>";
                        $("#menu_table tbody").append(tr_str);
                        }
                    else{
                            var tr_str = "<tr>" +
                                "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";

                            $("#menu_table tbody").append(tr_str);
                        }
                     }
                  });
               }
               else
               {
                var tr_str = "<tr>" +
                                "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";

                            $("#menu_table tbody").append(tr_str);
               }
            });    //end select change method


            


    });

    $(document).on("click", ".cart" , function() {
    var edit_id = $(this).data('id');
    var amount = $(this).data('amount');
    var qty=$("#qty").val();

  $.ajax({
    url: "{{ route('add_to_cart') }}",
    type: 'post',
    data: {_token: CSRF_TOKEN,edit_id: edit_id,amount: amount,qty:qty},
    success: function(dataResult){

                  swal({title: "Success", text: "Item Added!", type: "success"},
                            function(){ 
                                location.reload();
                            }
                        );

   
    }
  });

});




$(document).on("click", ".update" , function() {
  $.ajax({
    type: 'get',
    data: {_token: CSRF_TOKEN},
    success: function(data){
        $('#dataModal').modal('show'); 
   
    }
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

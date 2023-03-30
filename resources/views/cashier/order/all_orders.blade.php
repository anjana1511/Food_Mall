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
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-12">
                        <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Orders</h4>
                                    <div class="table-responsive">
                                        <table id="menu_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Customer Name</th>
                                                    <th>Mobile No.</th>
                                                    <th>Total Price</th>
                                                    <th style="text-align: center">Status</th>
                                                    <th style="text-align:center">Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $item)
                                                  <tr>
                                                    <td>{{ $item->cust_name }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td>{{ $item->total_amount }}</td>
                                                    <td style="text-align: center; width:10%">
                                                        @if($item->status == '0')
                                                       <button class=" btn btn-secondary update" data-toggle="modal" data-id="{{ $item->order_id }}">
                                                        Pending</button>
                                                        @elseif($item->status == '1')
                                                        <div class="btn btn-success update" data-toggle="modal" data-id="{{ $item->order_id }}">Confirm</div>
                                                        @elseif($item->status == '2')                        
                                                        <div class=" btn btn-danger update" data-toggle="modal" data-id="{{ $item->order_id }}">Cancel</div>
                                                        @endif
                                                    </td>
                                                    <td style="text-align:center">
                                                    @if($item->status == '1')
                                                  
                                                    <a href="{{ route('order.invoice_details_show',$item->order_id) }}"> <i class="mdi mdi-file-pdf"></i> </a> @endif
                                                    </td>
                                                 </tr>
                                            @endforeach  
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>    
                   
                </div><!-- end col-12 -->

                                <!-- Modal -->
                                <div id="dataModal" class="modal fade">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('order.changestatus')}}" method="post" enctype="multipart/form-data">
                                             {{ csrf_field() }}
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="cat_name" class="col-sm-3 text-right control-label col-form-label">Customer Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="hidden" id="edit_id" name="edit_id">
                                                        <input type="text" class="form-control" id="ecust_name" name="ecust_name" placeholder="Customer Name Here" readonly>
                                                        @if ($errors->has('ecust_name'))
                                                        <span class="text-danger">{{ $errors->first('ecust_name') }}</span>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="estatus" id="estatus">
                                                            <option value="0">Pandding</option>
                                                            <option value="1">Confirm</option>
                                                            <option value="2">Cancel</option>
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
                                </div><!-- End Modal -->



            </div>
        </div>
        <footer class="footer text-center">
            All Rights Reserved by Khoz Informatics Pvt. Ltd. Designed and Developed by <a href="https://khozinfo.com/">Khozinfo</a>.
        </footer>

    </div>

@endsection
        
@section('js')
<script  type="application/javascript">
   
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
        $(document).on("click", ".update" , function() {
    var edit_id = $(this).data('id');

  $.ajax({
    url: "{{ route('order.get_by_id') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(response){
        console.log(response);
        $('#edit_id').val(response.orderdata.order_id);
        $('#ecust_name').val(response.orderdata.cust_name);  
        // $('#estatus').html(data.catdata.status);
        $('#dataModal').modal('show'); 
   
    }
  });

});

$(document).on("click", ".invoice" , function() {
    var edit_id = $(this).data('id');

  $.ajax({

    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(response){
        console.log(response['data']);

        var len = 0;
        //    $('#invoice_table tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
             len = response['data'].length;
            
           }
           if(len > 0){
            for(var i=0; i<len; i++){
                
                var taluka_name = response['data'][i].cust_name;

                var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + taluka_name + "</td>" +

                   "</tr>";

             $("#invoice_table tbody").append(tr_str);
            }
           }

        // $("#invoice_table tbody").append(tr_str);

        $('#invoiceModal').modal('show'); 
   
    }
  });

});
</script>
@endsection
@extends('cashier.layout.master')

@section('content')

<div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Reservation</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
    <div class="row justify-content-center">
      <div class="col-md-9">
      <div class="card">
            <form class="form-horizontal" method="post" action="{{ route('reservetion.store') }}" enctype="multipart/form-data">
              @csrf
                <div class="card-body">
                     <h4 class="card-title">BOOK A TABLE</h4>
                     <hr />
                     <div class="form-group row">
                         <label for="cust_name" class="col-sm-3 text-right control-label col-form-label">Customer Name</label>
                         <div class="col-sm-9">
                                <select class="form-control" id="cust_name" name="cust_name">
                                         <option value="">Select Customer</option>
                                   @foreach($cust as $cdata)
                                          <option value="{{ $cdata->cust_id }}">{{ $cdata->cust_name }}</option>
                                    @endforeach
                                </select>  
                                 </select>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="food_name" class="col-sm-3 text-right control-label col-form-label">No of Guest</label>
                         <div class="col-sm-9">
         					<input type="number" class="form-control" placeholder="How many guests" min="1" name="guest" id="guest" required>
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="bdate" class="col-sm-3 text-right control-label col-form-label">Date</label>
                         <div class="col-sm-9">
                                <input type="date" class="form-control" name="date_res" placeholder="Select date for booking">
                         </div>
                     </div>
                     <div class="form-group row">
                         <label for="btime" class="col-sm-3 text-right control-label col-form-label">Time</label>
                         <div class="col-sm-9">
                         <input type="time" class="form-control" name="time" placeholder="Select time for booking" required>
                         </div>
                     </div>
                     <div class="form-group row">
                          <label class="col-sm-3 text-right control-label col-form-label">Suggestions <small><b>(E.g No of Plates, How you want the setup to be)</b></small></label>
					      <div class="col-sm-9">
                          <textarea class="form-control" name="suggestions" placeholder="your suggestions" required></textarea>
                          </div>
                     </div>
                            
                 </div>
                 <div class="border-top">
                      <div class="card-body">
                            <button type="submit" class="btn btn-primary">Book Table</button>
                            <input type="button" value="New Customer" class="btn btn-info customer">
                        </div>
                 </div>
            </form>
        </div> <!-- End Card -->
        @include('cashier.customer.create')
      </div><!-- end col-md-6 -->
 
   </div><!-- end row -->        
     </div><!-- End Container fluid -->
</div> <!-- end page wapper  -->

@endsection

@section('js')
<script  type="application/javascript">
   
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).on("click", ".customer" , function() {
  $.ajax({
    type: 'get',
    data: {_token: CSRF_TOKEN},
    success: function(data){
        $('#dataModal').modal('show'); 
   
    }
  });

});
    </script>
@endsection

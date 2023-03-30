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
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <form method="post" action="{{ route('order') }}">
                                            @csrf
                                    <div class="row mb-3 badge-pill badge-secondary">
                                        <div class="col-lg-2">
                                            If New Customer
                                        </div>
                                        <div class="col-lg-3">
                                            Select Customer
                                        </div>
                                        <div class="col-lg-2">
                                            Total Amount
                                        </div>
                                        <div class="col-lg-2">
                                            Total Quantity
                                        </div>
                                    </div>   
                                    <div class="row mb-3">
                                        <div class="col-lg-2">
                                            <input type="button" value="New Customer" class="btn btn-primary customer">
                                        </div>

                                        <div class="col-lg-3">
                                                <select class="form-control" name="cust_id">
                                                <option value="">Select Customer</option>
                                                @foreach($cust as $cdata)
                                                <option value="{{ $cdata->cust_id }}">{{ $cdata->cust_name }}</option>
                                                @endforeach
                                                </select>
                                        </div>
                                        @foreach($summ as $sdata)
                                        <div class="col-lg-2">
                                            <input type="text" value="{{ $sdata->tamount }}" name="tamount" class="form-control" readonly>
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="text" value="{{ $sdata->tqty }}" name="tqty" class="form-control" readonly>
                                        </div>
                                       @endforeach
                                         <div class="col-lg-3">
                                            <input type="submit" value="Confim Order" class="btn btn-primary">
                                        </div>
                                     
                                    </div>
                          </form>            
                        </div>


                    </div><!-- card -->
             </div>    <!-- end col-md-12 -->
                                
                @include('cashier.customer.create')
            </div> <!-- end row -->
            <div class="row">
                <div class="col-12">
                        <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Cart Items</h4>
                                    <div class="table-responsive">
                                        <table id="menu_table" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center">S.N</th>
                                                    <th style="text-align: center">Food Name</th>
                                                    <th style="text-align: center">Unit Price</th>
                                                    <th style="text-align: center">Quantity</th>
                                                    <th style="text-align: center">Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order_detail as $item)
                                                  <tr>
                                                  <th>{{$loop->index+1}}</th>
                                                    <td>
                                                        @if($item->food_name != null)
                                                        {{ $item->food_name }}
                                                        @else
                                                        {{ $item->menu_name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                    @if($item->price != null)
                                                        {{ $item->price }}
                                                        @else
                                                        {{ $item->menu_price }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->amount }}</td>                                                    
                                                 </tr>
                                            @endforeach
                                            @foreach($summ as $it)
                                                  
                                                  <tr>
 
                                                  <td colspan="4" align="right"><b>Total Quantity:-</td>
                                                  <td>{{ $it->tqty }}</b></td></tr>
                                                  <tr>
                                                  <td colspan="4" align="right"><b>Total Amount:-</td>
                                                  <td>{{ $it->tamount }}</b></td></tr>
                                            @endforeach       
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>                          
                </div><!-- end col-12 -->
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
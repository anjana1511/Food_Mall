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
                                                       <div class="badge-pill badge-secondary">Pending</div>
                                                        @elseif($item->status == '1')
                                                        <div class="badge-pill badge-success">Confirm</div>
                                                        @elseif($item->status == '2')                        
                                                        <div class="badge-pill badge-danger">Cancel</div>
                                                        @endif
                                                    </td>
                                                 </tr>
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
@endsection
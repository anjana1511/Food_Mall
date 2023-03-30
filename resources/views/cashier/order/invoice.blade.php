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
                                <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>   
        <div class="row">
              <div class="col-md-12">
                  <div class="card card-body printableArea" id="printableArea">
                       <h3><b>INVOICE</b> <span class="pull-right">#{{ $cust->order_id }}C{{ $cust->cust_id }}</span></h3>
                       Due Date. {{ date('d/m/Y', strtotime($cust->order_date))  }}
                       <br /> Invoice Date.  {{ date('d/m/Y', strtotime(now() )) }}
                       <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="pull-left">
                                    <address>
                                        <h4> &nbsp;<b class="text-danger">Food Mall</b></h4>
                                        <p class="text-muted m-l-5">E 104, Dharti-2,
                                        <br/> Nr' Viswakarma Temple,
                                        <br/> Bhavnagar - 364002</p>
                                    </address>
                                </div>
                            </div> 
                            <div class="col-md-6">   
                                <div class="pull-right text-right">
                                    <address>
                                        <h4>To,</h4>
                                        <h4 class="font-bold">{{ $cust['cust_name'] }}</h4>
                                        <p class="text-muted m-l-30">
                                        Mo.No.  {{ $cust['phone'] }}
                                       </p>
                                    </address>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                
                                <div class="table-responsive m-t-40" style="clear: both;">
                                    <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Description</th>
                                                        <th class="text-right">Quantity</th>
                                                        <th class="text-right">Unit Cost</th>
                                                        <th class="text-right">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($orders as $item)
                                                    <tr>
                                                        <td class="text-center">{{$loop->index+1}}</td>
                                                        <td>
                                                        @if($item->food_name != null)
                                                        {{ $item->food_name }}
                                                        @else
                                                        {{ $item->menu_name }}
                                                        @endif </td>
                                                        <td class="text-right">{{ $item->quantity }} </td>
                                                        <td class="text-right"> 
                                                        @if($item->price != null)
                                                        {{ $item->price }}
                                                        @else
                                                        {{ $item->menu_price }}
                                                        @endif    </td>
                                                        <td class="text-right"> {{ $item->amount }} </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                        </table>        
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        @foreach($summ as $sumdata)
                                        <p>Sub - Total amount: {{ $sumdata->total_amount }}</p>
                                        <p>Service Charge : 30 </p>
                                        <hr>
                                        <h3><b>Total :</b>{{ $sumdata->final_amount }}</h3>
                                        @endforeach
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-right">
                                        <button class="btn btn-danger" type="submit" onClick="PrintDiv();"> Proceed to payment </button>
                                    </div>
                                </div>
                        </div> <!-- end row -->

                  </div><!-- end card -->
              </div><!-- end col-md-12 -->
        </div><!-- end row -->
                                      
        <footer class="footer text-center">
            All Rights Reserved by Khoz Informatics Pvt. Ltd. Designed and Developed by <a href="https://khozinfo.com/">Khozinfo</a>.
        </footer>

    </div>

@endsection
        
@section('js')
<script type="text/javascript">   
function PrintDiv() {    
           var divToPrint = document.getElementById('printableArea');
           var popupWin = window.open('', '_blank');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }        
 </script>                                       
@endsection
<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customer = Customer::select('*')->paginate(5);
        return view('cashier.customer.index',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $adddata=[
            'cust_name' => $request->cust_name,
            'phone'  => $request->phone,
        ];
        // dd($adddata);
        $cust=Customer::create($adddata);

        if($adddata){
            return redirect()->back()->with('success','Customer Added Successfully');
        }
        else{
           return redirect()->back()->with('error','Customer Not Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $inputArr=$request->all();
        $customer['custdata']=Customer::where('cust_id','=',$inputArr['edit_id'])->first();
        return response()->json($customer);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $inputArr=$request->all();

        $updatedata=[
            'cust_name' => $request->ecust_name,
            'phone' => $request->ephone,
        ];
        $upd=Customer::where('cust_id','=',$request->edit_id)->update($updatedata);

        if($upd)
        {
            return redirect()->back()->with('success','Customer Added Successfully');
        }
        else{
           return redirect()->back()->with('error','Customer Not Added');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();
        $model = Customer::where('cust_id','=',$inputArr['id']);   
        $model->delete();

        return response()->json($inputArr['id']);
    }
    public function search(Request $request){
        
        $customer =Customer::where('cust_name', 'LIKE',"%{$request->search}%")->paginate(5);
        
        return view('cashier.customer.index',compact('customer'));

    }
}

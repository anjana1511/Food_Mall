<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReservationController extends Controller
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
        // $data = Reservation::select('*')->paginate(5);

        $data=Reservation::select('*')
               ->join('customers','customers.cust_id','=','reservation.cust_id')
              ->paginate(5);

        return view('admin.reservation.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // //
        // $table=Reservation::where('status','=','Available')->get();
        $cust=Customer::get()->all();
        return view('cashier.reservation.index',compact('cust'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tables = new Reservation();
        $tables -> no_of_guest = $request -> guest;
        $tables -> cust_id = $request -> cust_name;
        $tables->date_res=$request ->date_res;
        $tables -> time = $request -> time;
        $tables -> suggestions = $request -> suggestions;

        $data=$tables -> save();
        if($data){
       return redirect()->route('reservetion')->with('success', 'Table created successfully.');
       }
       else{
           return redirect()->route('reservetion')->with('error', 'Table Not Created.');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();
        $model = Reservation::where('reserve_id','=',$inputArr['id']);   
        $model->delete();

        return response()->json($inputArr['id']);
    }
}

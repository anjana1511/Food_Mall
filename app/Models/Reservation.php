<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // reservation
    protected $table='reservation';
    protected $primaryKey= 'reserve_id';
    protected $fillable=[
        'no_of_guest','cust_id','date_res','time','suggestions',
    ];
}

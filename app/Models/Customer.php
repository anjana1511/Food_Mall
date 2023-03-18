<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table='customers';
    protected $primaryKey='cust_id';

    protected $fillable=[
        'cust_name','phone'
    ];

}

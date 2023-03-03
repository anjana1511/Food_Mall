<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table='foods';
    protected  $primaryKey = 'food_id';
    protected $fillable= [
        'food_name',
        'food_description',
        'price',
        'cat_id',
        'image',
        'status',

    ];
}

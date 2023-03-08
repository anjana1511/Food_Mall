<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_Item extends Model
{
    use HasFactory;
protected $table='menu_item';
protected $primaryKey='item_id';

protected $fillable=[
    'menu_id',
    'cat_id',
    'food_id',
];
}

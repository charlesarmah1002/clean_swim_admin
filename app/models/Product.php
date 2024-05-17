<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

class Product extends Eloquent
{
    protected $fillable = [ 
        'p_name',
        'p_price',
        'c_id',
        'p_description',
        'p_image',
        'stock'
    ];
}
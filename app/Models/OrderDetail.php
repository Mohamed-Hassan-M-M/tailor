<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $fillable = [
        'id', 'order_id', 'product_color_size_id', 'quantity'
    ];
    public $timestamps = false;
    public function Order(){
        return $this -> belongsTo(Order::class,'order_id');
    }
    public function Product(){
        return $this -> belongsTo(ProductColorSize::class,'product_color_size_id');
    }
}

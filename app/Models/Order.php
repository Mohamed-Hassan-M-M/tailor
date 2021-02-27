<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'id', 'customer_id', 'date', 'deliver'
    ];
    public $timestamps = false;
    public function Customer(){
        return $this -> belongsTo(Customer::class,'customer_id');
    }
    public function OrderDetail(){
        return $this -> hasMany(OrderDetail::class,'order_id');
    }
}

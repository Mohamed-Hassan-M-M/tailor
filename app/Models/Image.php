<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'id', 'name', 'product_color_id'
    ];
    public $timestamps = false;
    public function ProductColor(){
        return $this -> belongsTo(ProductColor::class,'product_color_id');
    }
    public function getNameAttribute($val){
        return ($val !== null) ? asset('Dashboard/'.$val) : "";
    }
}

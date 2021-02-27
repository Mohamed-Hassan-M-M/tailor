<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id', 'name', 'description', 'price', 'discount', 'barcode', 'brand_id', 'category_id'
    ];
    public $timestamps = false;
    public function Brand(){
        return $this -> belongsTo(Brand::class,'brand_id');
    }
    public function Category(){
        return $this -> belongsTo(Categoryl2::class,'category_id');
    }
}

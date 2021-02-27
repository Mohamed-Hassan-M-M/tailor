<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $table = 'product_colors';
    protected $fillable = [
        'id', 'product_id', 'color_id'
    ];
    public $timestamps = false;
    public function Product(){
        return $this -> belongsTo(Product::class,'product_id');
    }
    public function Color(){
        return $this -> belongsTo(Color::class,'color_id');
    }
    public function Image(){
        return $this -> hasMany(Image::class,'product_color_id');
    }
}

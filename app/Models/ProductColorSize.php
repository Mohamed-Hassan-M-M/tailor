<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColorSize extends Model
{
    protected $table = 'product_colors_sizes';
    protected $fillable = [
        'id', 'size_id', 'product_color_id', 'count'
    ];
    public $timestamps = false;
    public function Size(){
        return $this -> belongsTo(Size::class,'size_id');
    }
    public function ProductColor(){
        return $this -> belongsTo(ProductColor::class,'product_color_id');
    }
}

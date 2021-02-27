<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'subcategories';
    protected $fillable = [
        'id', 'name', 'description', 'image', 'main_category_id'
    ];
    public $timestamps = false;
    public function mainCategory(){
        return $this -> belongsTo(MainCategory::class,'main_category_id');
    }
    public function categoryl1(){
        return $this -> hasMany(Categoryl1::class,'sub_category_id');
    }
    public function getImageAttribute($val){
        return ($val !== null) ? asset('Dashboard/'.$val) : "";
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'maincategories';
    protected $fillable = [
        'id', 'name', 'description', 'image'
    ];
    public $timestamps = false;
    public function getImageAttribute($val){
        return ($val !== null) ? asset('Dashboard/'.$val) : "";
    }
    public function subCategory(){
        return $this -> hasMany(SubCategory::class,'main_category_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoryl1 extends Model
{
    protected $table = 'categorieslevel1';
    protected $fillable = [
        'id', 'name', 'description', 'image', 'sub_category_id'
    ];
    public $timestamps = false;
    public function subCategory(){
        return $this -> belongsTo(SubCategory::class,'sub_category_id');
    }
    public function categoryl2(){
        return $this -> hasMany(Categoryl2::class,'category_level1_id');
    }
    public function getImageAttribute($val){
        return ($val !== null) ? asset('Dashboard/'.$val) : "";
    }
}

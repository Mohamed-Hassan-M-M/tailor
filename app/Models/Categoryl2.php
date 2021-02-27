<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoryl2 extends Model
{
    protected $table = 'categorieslevel2';
    protected $fillable = [
        'id', 'name', 'description', 'image', 'category_level1_id'
    ];
    public $timestamps = false;
    public function subCategory(){
        return $this -> belongsTo(Categoryl1::class,'category_level1_id');
    }
    public function getImageAttribute($val){
        return ($val !== null) ? asset('Dashboard/'.$val) : "";
    }
}

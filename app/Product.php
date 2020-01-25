<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Table name
    public $table = 'products';
    //Primary Key
    //public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    protected $fillable = ['quantity'];
    public function categories(){

        return $this->belongsToMany('App\Category');

    }

    // public function scopeMightAlsoLike($query){
    //     return $query->inRandomOrder()->take(4);
    // }


}

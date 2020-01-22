<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'billing_email', 'billing_address', 'billing_fname', 'billing_lname',
        'billing_province', 'billing_zip', 'billing_phone', 'billing_total', 'billing_subtotal', 'error',
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function products(){
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}

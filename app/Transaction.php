<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['order_id', 'paid_amount',
                        'balance', 'transac_date',
                        'transac_amount', 'user_id',
                        'payment_method'];

        public function orderdetail(){
            return $this->hasMany('App\Order_Detail');
        }

        public function order_detail(){
            return $this->belongsTo('App\Order', 'order_id', 'id');
        }
        public function user_detail(){
            return $this->belongsTo('App\User', 'user_id', 'id');
        }
}
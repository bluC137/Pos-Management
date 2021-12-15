<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Returned extends Model
{
    protected $table = 'returned';
    protected $fillable = ['product_name', 'quantity',
                        'reason', 'date'];
}

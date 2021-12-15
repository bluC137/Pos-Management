<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stockin extends Model
{
    protected $table = 'stockins';
    protected $fillable = ['id', 'product_id',
                        'quantity', 'supplier','remarks','receiver'];
}

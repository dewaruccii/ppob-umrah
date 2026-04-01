<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function Product()
    {
        return $this->hasOne(Product::class, 'uuid', 'product_id');
    }
}

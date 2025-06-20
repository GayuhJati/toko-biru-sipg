<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['photo','name', 'sku', 'price', 'stock'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

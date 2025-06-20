<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['invoice_number', 'total'];

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

}

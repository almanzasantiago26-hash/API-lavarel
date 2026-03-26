<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total', 'status', 'metodo_pago'];

    protected $casts = [
        'user_id' => 'integer',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

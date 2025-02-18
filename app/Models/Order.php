<?php

namespace App\Models;
use App\Models\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   // In Order model
public function product()
{
    return $this->belongsTo(Product::class);
}

public function customer()
{
    return $this->belongsTo(Customers::class, 'user_id', 'UserId');
}
}
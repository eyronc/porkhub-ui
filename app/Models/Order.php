<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = [
        'user_id',
        'restaurant_branch_id',
        'total_amount',
        'status',
        'payment_method',
    ];

    /**
     * Relationships
     */

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The branch where the order was placed
    public function restaurantBranch()
    {
        return $this->belongsTo(RestaurantBranch::class, 'restaurant_branch_id');
    }

    // Order items in this order
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Payment transaction
    public function payment()
    {
        return $this->hasOne(PaymentTransaction::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantBranch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',       
        'address',   
        
    ];

    /**
     * Relationships
     */

    // A branch can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}

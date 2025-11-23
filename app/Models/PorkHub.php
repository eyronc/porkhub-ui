<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PorkHub extends Model
{
    /** @use HasFactory<\Database\Factories\PorkHubFactory> */
    use HasFactory;
    protected $fillable = [
    'product_name',
    'product_price',
    'stock',
    'product_description',
    'category',
    'image_path'
    ];
}

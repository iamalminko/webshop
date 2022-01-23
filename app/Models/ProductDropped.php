<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDropped extends Model
{
    use HasFactory;
    protected $table = 'dropped_products';
}

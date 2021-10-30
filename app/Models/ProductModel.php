<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id', 'name', 'description', 'price', 'image_url'
    ];
    protected $hidden = [
        'password', 'api_token'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $visible = ['id', 'active', 'categoryId', 'enName', 'created_at', 'updated_at'];
    protected $fillable = ['id', 'active', 'categoryId', 'enName', 'created_at', 'updated_at'];
    protected $table = 'products';
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}
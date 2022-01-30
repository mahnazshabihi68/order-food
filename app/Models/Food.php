<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';
    use HasFactory;

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class);
    }
}

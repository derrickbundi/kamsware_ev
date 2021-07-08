<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = ['location' => 'array'];
    public function products() {
        return $this->hasMany(Product::class);
    }
}

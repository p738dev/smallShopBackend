<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'desc',
        'category',
        'price',
        'image',
        'quantity'
    ];

    public function orders () {
        return $this->belongsToMany(Order::class);
    }
}
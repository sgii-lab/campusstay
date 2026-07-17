<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'price',
        'image',
        'status',
        'landlord_id',
    ];

    // Each property belongs to a landlord (user)
    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }
}

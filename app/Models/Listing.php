<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // Fillable fields (adjust to your schema)
    protected $fillable = [
        'title',
        'description',
        'location',
        'school',
        'price',
        'image',
        'status',
        'landlord_id',
    ];

    // Relationship to landlord
    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id');
        // Or Landlord::class if you have a separate model
    }
}

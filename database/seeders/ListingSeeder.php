<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        Listing::create([
            'title' => 'Test Room',
            'description' => 'Simple test listing',
            'location' => 'Marondera',
            'price' => 300,
            'status' => 'approved',
            'landlord_id' => 1, // must match an existing user/landlord
        ]);
        
    }
}

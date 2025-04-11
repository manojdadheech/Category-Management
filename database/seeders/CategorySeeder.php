<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();

        // Top-level categories
        $bedroom = Category::create(['name' => 'Bedroom', 'status' => 1]);
        $livingRoom = Category::create(['name' => 'Living Room', 'status' => 1]);

        // Bedroom children
        $beds = Category::create(['name' => 'Beds', 'status' => 1, 'parent_id' => $bedroom->id]);
        Category::create(['name' => 'Panel Bed', 'status' => 1, 'parent_id' => $beds->id]);
        Category::create(['name' => 'Night Stand', 'status' => 1, 'parent_id' => $bedroom->id]);
        Category::create(['name' => 'Dresser', 'status' => 1, 'parent_id' => $bedroom->id]);

        // Living Room children
        Category::create(['name' => 'Sofas', 'status' => 1, 'parent_id' => $livingRoom->id]);
        Category::create(['name' => 'Loveseats', 'status' => 1, 'parent_id' => $livingRoom->id]);

        $tables = Category::create(['name' => 'Tables', 'status' => 1, 'parent_id' => $livingRoom->id]);
        Category::create(['name' => 'Coffee Table', 'status' => 1, 'parent_id' => $tables->id]);
        Category::create(['name' => 'Side Table', 'status' => 1, 'parent_id' => $tables->id]);
    }
}

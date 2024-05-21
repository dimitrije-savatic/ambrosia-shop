<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public $now = Carbon::DEFAULT_TO_STRING_FORMAT;

    private $categories = ['fruits', 'vegetables', 'herbs'];

    public function run(): void
    {
        foreach ($this->categories as $category){
            Category::create([
                'name' => $category
            ]);
        }
    }
}

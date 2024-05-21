<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $names = ['apples', 'pears', 'grapes', 'peaches', 'plums', 'walnuts', 'almonds', 'hazelnuts', 'tomato', 'cucumber', 'bean', 'lentil', 'parsley', 'basil', 'oregano', 'laurel'];
    private $category = [1,1,1,1,1,1,1,1,2,2,2,2,3,3,3,3];


    public function run(): void
    {
        for ($i = 0; $i < count($this->names); $i++) {
            $product = Product::create([
                'name' => $this->names[$i],
                'price' => rand(1,3),
                'old_price' => rand(4, 6),
                'category_id' => $this->category[$i]
            ]);
            Product::where('id', $product->id)->update(['image' => $product->id. '.jpg']);
        }
    }
}

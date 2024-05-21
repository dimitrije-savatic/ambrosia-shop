<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Home', 'Products', 'Contact'];

        $routes = ['home', 'products', 'contact'];

        for ($i=0;$i<count($names);$i++){
            Menu::create([
               'name' => $names[$i],
               'route' => $routes[$i]
            ]);
        }
    }
}

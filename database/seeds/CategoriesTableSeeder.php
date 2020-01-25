<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'=> 'Fruity',
        ]);
        Category::create([
            'name'=> 'Pastry',
        ]);
        Category::create([
            'name'=> 'Tobacco',
        ]);
        Category::create([
            'name'=> 'Mentholated',
        ]);
    }
}

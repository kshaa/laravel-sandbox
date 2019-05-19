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
        Category::truncate();
        Category::create(array('id' => 1, 'name' => 'Music'));
        Category::create(array('id' => 2, 'name' => 'Theatre'));
        Category::create(array('id' => 3, 'name' => 'Sports'));
        Category::create(array('id' => 4, 'name' => 'Family'));
        Category::create(array('id' => 5, 'name' => 'Festivals'));
        Category::create(array('id' => 6, 'name' => 'Exhibitions'));
        Category::create(array('id' => 7, 'name' => 'Movies'));
    }
}

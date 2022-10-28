<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Wallet', 'Purse', 'Key', 'Phone',
            'Tablet', 'Book', 'Laptop', 'Bag', 'Clothes', 'Others'];

        foreach ($categories as $name){
            $category = new Category();
            $category->name = $name;
            $category->save();
        }
    }
}

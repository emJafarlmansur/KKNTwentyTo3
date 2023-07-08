<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder

    {
    
        public function run(): void
        {
           Schema::disableForeignKeyConstraints();
           Category::truncate();
           Schema::enableForeignKeyConstraints();
    
           $data=[
            'fiksi','agama','science'
           ];
           foreach ($data as $value) {
            Category::insert(['name'=>$value]);
            };
        }
    
}

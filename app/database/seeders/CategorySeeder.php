<?php

namespace Database\Seeders;

use App\Models\Category;
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
        //
        $categories = config("drgcode.categories");

        foreach ($categories as $category){
            $newCategory = new Category();
            $newCategory->name = $category["name"];
            $newCategory->slag = strtolower(str_replace(" ","-",$category["name"]));
            $newCategory->parent_id = null;
            $newCategory->save();
            foreach ($category["subcategories"] as $subcategory){
                $newSubcategory = new Category();
                $newSubcategory->name = $subcategory;
                $newSubcategory->slag = strtolower(str_replace(" ","-",$subcategory));
                $newSubcategory->parent_id = $newCategory->id;
                $newSubcategory->save();
            }
        }

    }
}

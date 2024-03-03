<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Transaction;
use Carbon\Carbon;
use Faker\Factory as Faker;

use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $categories = Category::where("parent_id",null)->get();
        for ($i = 0; $i < 1000; $i++) {
            // Escoger una categoría aleatoria
            $category = $categories->random();
            $startDate = Carbon::now()->subMonth()->startOfMonth();
            $endDate = Carbon::now();
            $date = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d');

            // Crear una transacción con datos aleatorios
            Expense::create([
                'amount' => $faker->randomFloat(2, 1, 1000),
                'description' => $faker->sentence(),
                'date' => $date,
                'hour' => $faker->time(),
                'currency_id' => 1, // Supongamos que 1 es el ID de la moneda
                'category_id' => $category->id,
                'subcategory_id' => $faker->randomElement(Category::where('parent_id', $category->id)->pluck('id')),
            ]);
        }
    }
}

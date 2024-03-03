<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['name' => 'United States Dollar', 'symbol' => '$', 'code' => 'USD'],
            ['name' => 'Euro', 'symbol' => '€', 'code' => 'EUR'],
            ['name' => 'Japanese Yen', 'symbol' => '¥', 'code' => 'JPY'],
            ['name' => 'British Pound Sterling', 'symbol' => '£', 'code' => 'GBP'],
            ['name' => 'Australian Dollar', 'symbol' => 'A$', 'code' => 'AUD'],
            ['name' => 'Canadian Dollar', 'symbol' => 'C$', 'code' => 'CAD'],
            ['name' => 'Swiss Franc', 'symbol' => 'CHF', 'code' => 'CHF'],
            ['name' => 'Chinese Yuan', 'symbol' => '¥', 'code' => 'CNY'],
            ['name' => 'Swedish Krona', 'symbol' => 'kr', 'code' => 'SEK'],
            ['name' => 'New Zealand Dollar', 'symbol' => 'NZ$', 'code' => 'NZD'],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}

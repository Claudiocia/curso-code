<?php

use Illuminate\Database\Seeder;
use pizzaexpress\Models\Cupom;
use pizzaexpress\Models\Product;

class CupomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cupom::class, 10)->create();
    }
}

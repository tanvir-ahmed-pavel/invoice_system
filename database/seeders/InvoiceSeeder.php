<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::factory()->count(100)
            ->has(Item::factory()->count(3), 'items')
            ->create();
    }
}

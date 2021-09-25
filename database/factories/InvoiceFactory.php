<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_signature' => $this->faker->uuid(),
            'user_id' => 1,
            'invoice_type' => "Monthly",
            'subject' => "Invoice for monthly basis",
            'sub_total' => 10000,
            'net_amount' => 10000,
            'date' => $this->faker->date,
            'company_id'=>1,
            'client_id'=>1,
            'driver_id'=>1,
            'invoice_number' => Str::random(6),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'company_name' => 'Jinia  Enterprise',
            'company_address' => 'Room #4, 42, Sabera Tower, Gulshan-2, Dhaka-1212',
            'company_contact' => '01716633445, 01534280295',
            'company_email' => 'jiniaenterprise.com@gmail.com',
            'company_website' => 'www.jiniaenterprise.com',
            "user_id" => '1'
        ]);

        Company::create([
            'company_name' => 'Shanta Corporation',
            'company_address' => 'Room #4, 42, Sabera Tower, Gulshan-2, Dhaka-1212',
            'company_contact' => '01716633445, 01534280295',
            'company_email' => 'shantacorp@gmail.com',
            "user_id" => '1'
        ]);
    }
}

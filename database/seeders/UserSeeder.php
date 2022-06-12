<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usr = User::create([
            'first_name'=> 'Super Admin',
            'middle_name'=> '',
            'last_name'=> 'Admin',
            'email' => 'admin@email.com',
            'phone_number' => '0700000001',
            'role_id' => '1',
            'county' => 'Kiambu',
            'sub_county' => 'Lari',
            'constituency' => 'Lari',
            'ward' => 'Kereita',
            'landmark' => '',
            'terms_and_conditions' => '1',
            'password' => bcrypt('admin123456'),
        ]);
    }
}

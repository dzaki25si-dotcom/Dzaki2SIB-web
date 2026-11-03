<?php

namespace Database\Seeders;
use App\Models\Pelanggan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatePelangganUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Pelanggan::create([
            'first_name' =>'John',
            'last_name' =>'Doe',
            'birthday' => '2000/01/01',
            'gender' => 'Male',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890'
        ]);
    }
}

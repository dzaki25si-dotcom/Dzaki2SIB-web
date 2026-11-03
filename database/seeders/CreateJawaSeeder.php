<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstNames = [
            'Budi', 'Bambang', 'Slamet', 'Joko', 'Agung', 'Agus', 'Sri', 'Dewi', 'Endang', 'Titi',
            'Tri', 'Dwi', 'Eko', 'Cahyo', 'Sugeng', 'Surya', 'Suprapto', 'Suharto', 'Sukarno', 'Subagyo',
            'Retno', 'Wati', 'Rahayu', 'Siti', 'Yuni', 'Harti', 'Purwanto', 'Haryanto', 'Darmono', 'Gunawan',
            'Gatot', 'Kusuma', 'Kurniawan', 'Satria', 'Wibowo', 'Prabowo', 'Utomo', 'Wibisono', 'Kusumo', 'Prasetyo'
        ];

        $middleNames = [
            'Purnomo', 'Santoso', 'Pratama', 'Saputra', 'Setiawan', 'Budiman', 'Susanto', 'Hidayat', 'Kurnia', 'Sulistyo',
            'Nur', 'Rahman', 'Tri', 'Dwi', 'Agung', 'Cahya', 'Kusuma', 'Pratami', 'Ayu', 'Lestari',
            'Widodo', 'Wibowo', 'Suharto', 'Subandi', 'Sugiarto', 'Sudrajat', 'Suryono', 'Purwanto', 'Haryanto', 'Gunawan'
        ];

        $lastNames = [
            'Wibowo', 'Prasetyo', 'Suryanto', 'Utomo', 'Santoso', 'Saputra', 'Setiawan', 'Budiman', 'Kurniawan', 'Subagyo',
            'Wijaya', 'Nugroho', 'Wicaksono', 'Hadiningrat', 'Kusumo', 'Wibisono', 'Susilo', 'Yudhistira', 'Baskoro', 'Sujatmiko',
            'Purwanto', 'Haryanto', 'Darmono', 'Gunawan', 'Suprapto', 'Suharto', 'Sukarno', 'Subakti', 'Lestari', 'Rahayu'
        ];

        $users = [];
        $now = Carbon::now();
        $password = Hash::make('password123'); // Password default untuk semua user

        for ($i = 1; $i <= 100; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $middleName = $middleNames[array_rand($middleNames)];
            $lastName = $lastNames[array_rand($lastNames)];

            $name = "$firstName $middleName $lastName";
            
            // Format email unik berurut: budi.santoso1@example.com
            $cleanFirstName = Str::slug($firstName);
            $cleanLastName = Str::slug($lastName);
            $email = "{$cleanFirstName}.{$cleanLastName}{$i}@example.com";

            $users[] = [
                'name'              => $name,
                'email'             => $email,
                'email_verified_at' => $now,
                'password'          => $password,
                'remember_token'    => Str::random(10),
                'created_at'        => $now,
                'updated_at'        => $now,
            ];
        }

        // Insert massal 100 baris sekaligus
        DB::table('users')->insert($users);
    }
}
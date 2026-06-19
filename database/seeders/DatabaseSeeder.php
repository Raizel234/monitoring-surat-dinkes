<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@dinkes.com',
            'role' => 'admin',
            'instansi' => 'Dinas Kesehatan Kabupaten Sumenep',
            'jabatan' => 'Administrator Sistem',
        ]);

        User::factory()->create([
            'name' => 'Kepala Dinas',
            'email' => 'kadinas@dinkes.com',
            'role' => 'atasan',
            'instansi' => 'Dinas Kesehatan Kabupaten Sumenep',
            'jabatan' => 'Kepala Dinas Kesehatan',
        ]);

        User::factory()->create([
            'name' => 'Pegawai',
            'email' => 'pegawai@dinkes.com',
            'role' => 'pegawai',
            'instansi' => 'Dinas Kesehatan Kabupaten Sumenep',
            'jabatan' => 'Staf Administrasi',
        ]);
    }
}

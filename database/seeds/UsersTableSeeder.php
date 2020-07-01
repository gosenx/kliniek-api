<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Authentication\Admin;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()->create([
            'role' => 'receptionist'
        ])->user()->create([
            'fullname' => 'Inês Amélia Tivane',
            'email' => 'inestivane@gmail.com',
            'password' => Hash::make('recept$ecret'),
            'gender' => 'female',
            'address' => 'chamanculo',
            'birthdate' => '1999/04/25',
        ]);

        Admin::query()->create([
            'role' => 'admin'
        ])->user()->create([
            'fullname' => 'Tiago Barbosa Jr.',
            'email' => 'tiagobarbosa.jr@gmail.com',
            'password' => Hash::make('admin$ecret'),
            'gender' => 'male',
            'address' => 'costa do sol',
            'birthdate' => '1991/11/13',
        ]);

        Admin::query()->create([
            'role' => 'super_admin'
        ])->user()->create([
            'fullname' => 'Paulo Amosse Cuambe',
            'email' => 'pamossecuambe@gmail.com',
            'password' => Hash::make('super$ecret'),
            'gender' => 'male',
            'address' => 'kumbeza',
            'birthdate' => '1999/08/30',
        ]);

    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Authentication\Doctor;
use Illuminate\Support\Str;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::query()->create([
            'certification_code' => rand(10134, 19765) . strtoupper('-' . Str::random(1)),
            'specialty_id' => rand(1, 9)
        ])->user()->create([
            'fullname' => 'Joseph André Mulima',
            'email' => 'joseph.mulima@gmail.com',
            'gender' => 'male',
            'address' => 'boquisso',
            'birthdate' => '1992/07/13',
        ]);

        Doctor::query()->create([
            'certification_code' => rand(10134, 19765) . strtoupper('-' . Str::random(1)),
            'specialty_id' => rand(1, 9)
        ])->user()->create([
            'fullname' => 'Marta Tivane',
            'email' => 'marta.tivane@gmail.com',
            'gender' => 'female',
            'address' => 'guava',
            'birthdate' => '1985/07/29',
        ]);

        Doctor::query()->create([
            'certification_code' => rand(10134, 19765) . strtoupper('-' . Str::random(1)),
            'specialty_id' => rand(1, 9)
        ])->user()->create([
            'fullname' => 'Judite Pedro Zandamela',
            'email' => 'jud.zanda21@gmail.com',
            'gender' => 'female',
            'address' => 'matola',
            'birthdate' => '1980/01/15',
        ]);

        Doctor::query()->create([
            'certification_code' => rand(10134, 19765) . strtoupper('-' . Str::random(1)),
            'specialty_id' => rand(1, 9)
        ])->user()->create([
            'fullname' => 'Olga Zeferrino Tembe',
            'email' => 'olgazefferino@gmail.com',
            'gender' => 'female',
            'address' => 'zona verde',
            'birthdate' => '1993/11/12',
        ]);

        Doctor::query()->create([
            'certification_code' => rand(10134, 19765) . strtoupper('-' . Str::random(1)),
            'specialty_id' => rand(1, 9)
        ])->user()->create([
            'fullname' => 'Ibraimo Assane Mujad',
            'email' => 'ibra.mujad@gmail.com',
            'gender' => 'male',
            'address' => 'alto maé',
            'birthdate' => '1989/08/24',
        ]);

        Doctor::query()->create([
            'certification_code' => rand(10134, 19765) . strtoupper('-' . Str::random(1)),
            'specialty_id' => rand(1, 9)
        ])->user()->create([
            'fullname' => 'Júlio Coelho Salazar Jr.',
            'email' => 'jcoelhojr@gmail.com',
            'gender' => 'male',
            'address' => 'polana cimento',
            'birthdate' => '1978/07/10',
        ]);
    }
}

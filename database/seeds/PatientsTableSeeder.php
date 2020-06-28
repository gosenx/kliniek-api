<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Authentication\Patient;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::query()->create([
            'job_title' => 'mecânico',
            'patient_code' => strtotime('now'),
        ])->user()->create([
            'fullname' => 'Hilario Comé',
            'email' => 'hilario.come@gmail.com',
            'gender' => 'male',
            'address' => 'chamanculo b',
            'birthdate' => '1972/06/21',
        ]);

        Patient::query()->create([
            'job_title' => 'comerciante',
            'patient_code' => strtotime('now +2 days'),
        ])->user()->create([
            'fullname' => 'Miranda Júlio Rosa',
            'email' => 'mira.rosa@gmail.com',
            'gender' => 'female',
            'address' => 'liberdade',
            'birthdate' => '1990/12/30',
        ]);

        Patient::query()->create([
            'job_title' => 'estudante',
            'patient_code' => strtotime('now -150 days'),
        ])->user()->create([
            'fullname' => 'José Souza',
            'email' => 'jose.souza@gmail.com',
            'gender' => 'male',
            'address' => 'sommerschield',
            'birthdate' => '1995/04/01',
        ]);

        Patient::query()->create([
            'job_title' => 'estudante',
            'patient_code' => strtotime('now -450 day'),
        ])->user()->create([
            'fullname' => 'Mirela Adimo Zulo',
            'email' => 'mirelazulo@gmail.com',
            'gender' => 'female',
            'address' => 'maxaquene',
            'birthdate' => '1999/01/31',
        ]);

        Patient::query()->create([
            'job_title' => 'programadora',
            'patient_code' => strtotime('now +15 days'),
        ])->user()->create([
            'fullname' => 'Jéssica Natália Gomez',
            'email' => 'jéssica.gomez@gmail.com',
            'gender' => 'female',
            'address' => 'inhagoi',
            'birthdate' => '1999/03/25',
        ]);

        Patient::query()->create([
            'job_title' => 'estudante',
            'patient_code' => strtotime('now -5 years'),
        ])->user()->create([
            'fullname' => 'Lucas Alberto Cuinica',
            'email' => 'lucas.cuinica@gmail.com',
            'gender' => 'male',
            'address' => 'matendene',
            'birthdate' => '1998/06/25',
        ]);

        Patient::query()->create([
            'job_title' => 'estudante',
            'patient_code' => strtotime('now -2 days'),
        ])->user()->create([
            'fullname' => 'Celeste Amosse Cuambe',
            'email' => 'celeste.amosse04@gmail.com',
            'gender' => 'female',
            'address' => 'kumbeza',
            'birthdate' => '2004/05/30',
        ]);

        Patient::query()->create([
            'job_title' => 'jardineiro',
            'patient_code' => strtotime('now -6 years'),
        ])->user()->create([
            'fullname' => 'Lino Sotomane',
            'email' => 'lsotomane@gmail.com',
            'gender' => 'male',
            'address' => 'matola 700',
            'birthdate' => '2002/10/17',
        ]);

        Patient::query()->create([
            'job_title' => 'policia',
            'patient_code' => strtotime('now +8 days'),
        ])->user()->create([
            'fullname' => 'Josué Adalberto Cossa',
            'email' => 'jos.adalbertocossa@gmail.com',
            'gender' => 'male',
            'address' => 'agostinho neto',
            'birthdate' => '1993/10/23',
        ]);

        Patient::query()->create([
            'job_title' => 'professor',
            'patient_code' => strtotime('now +2 months'),
        ])->user()->create([
            'fullname' => 'Tomás Mondlane',
            'email' => 'tomas.mondlane@gmail.com',
            'gender' => 'male',
            'address' => 'magonine - cmc',
            'birthdate' => '1994/07/07',
        ]);
    }
}

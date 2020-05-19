<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('specialties');

        $table->insert([
            'name' => 'Medicina Interna',
            'slug' => 'medicina-interna',
            'description' => 'O especialista desta area avalia o doente adulto no seu todo, relacionando a complexidade do corpo humano e interagindo com os vários problemas que o podem afetar.',
        ]);

        $table->insert([
            'name' => 'Pediatria',
            'slug' => 'pediatria',
            'description' => 'A pediatria é o ramo da medicina dedicado à assistência à criança e ao adolescente, nos seus diversos aspectos, sejam eles preventivos ou curativos.',
        ]);

        $table->insert([
            'name' => 'Ginecologia',
            'slug' => 'ginecologia',
            'description' => 'A genicologia é o ramo da medicina que tem por objetivo o tratamento dos aspectos relacionados com a função reprodutora e sexual das mulheres.',
        ]);

        $table->insert([
            'name' => 'Obstetricia',
            'slug' => 'obstetricia',
            'description' => 'A obstetrícia é o ramo da medicina que estuda a reprodução na mulher. Investiga a gestação, o parto e o puerpério nos seus aspectos fisiológicos e patológicos.',
        ]);

        $table->insert([
            'name' => 'Dermatologia',
            'slug' => 'dermatologia',
            'description' => 'A Dermatologia é o ramo da medicina que se concentra no diagnóstico, prevenção e tratamento de doenças e afecções relacionadas à pele, pelos, mucosas, cabelo e unhas. É também especialidade indicada para atuação em procedimentos médicos estéticos, cirúrgicos, oncológicos.',
        ]);

        $table->insert([
            'name' => 'Psicologia Infantil e Geral',
            'slug' => 'psicologia-infantil-geral',
            'description' => 'Psicologia é o estudo do comportamento e as funções mentais. Tem como objetivo imediato a compreensão de grupos e indivíduos tanto pelo estabelecimento de princípios universais como pelo estudo de casos específicos, e tem como objetivo final o benefício geral da sociedade.',
        ]);

        $table->insert([
            'name' => 'Nutricionista',
            'slug' => 'nutricionista',
            'description' => 'O nutricionista é o profissional da saúde que estuda os alimentos e seus efeitos no organismo humano. Ele preza pela qualidade da alimentação das pessoas, individualmente ou em grupo, indicando quais alimentos podem ser consumidos para garantir uma alimentação saudável, nutritiva e equilibrada.',
        ]);

        $table->insert([
            'name' => 'Otorrinolarinologia',
            'slug' => 'otorrinolarinologia',
            'description' => 'A otorrinolaringologia cuida de algumas das funções e sentidos do corpo humano mais importantes para uma vida saudável: o olfato, a fala, a respiração, a audição e o equilíbrio, ou seja, o otorrinolaringologista é responsável por tratar e prevenir doenças e distúrbios da orelha, nariz, garganta e estruturas corporais relacionadas.',
        ]);

        $table->insert([
            'name' => 'Urologia',
            'slug' => 'urologia',
            'description' => 'Urologia é uma especialidade cirúrgica da medicina que trata do trato urinário de homens e de mulheres e do sistema reprodutor das pessoas do sexo masculino.',
        ]);
    }
}

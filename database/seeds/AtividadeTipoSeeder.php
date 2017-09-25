<?php

use Illuminate\Database\Seeder;

class AtividadeTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atividades_tipos')->insert([
            [
                'nome' => 'Palestra'
            ],
            [
                'nome' => 'Oficina'
            ],
            [
                'nome' => 'Mini-Curso'
            ],
            [
                'nome' => 'Mesa Redonda'
            ]
        ]);
    }
}

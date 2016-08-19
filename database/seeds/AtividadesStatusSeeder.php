<?php

use Illuminate\Database\Seeder;

class AtividadesStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('atividades_status')->insert([
            [
                'nome' => 'Proposta'
            ],
            [
                'nome' => 'Análise'
            ],
            [
                'nome' => 'Aceita'
            ],
            [
                'nome' => 'Recusada'
            ]
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidades')->insert([
            [
                'nome' => 'Campus Juiz de Fora'
            ],
            [
                'nome' => 'Campus Barbacena'
            ],
            [
                'nome' => 'Campus Manhuaçu'
            ],
            [
                'nome' => 'Campus Muriaé'
            ],
            [
                'nome' => 'Campus Rio Pomba'
            ],
            [
                'nome' => 'Campus São João del-Rei'
            ],
            [
                'nome' => 'Campus Santos Dummont'
            ]
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class UsuariosTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios_tipos')->insert([
            [
                'nome' => 'Aluno'
            ],
            [
                'nome' => 'Servidor'
            ],
            [
                'nome' => 'Externo'
            ]
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class UsuariosGruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios_grupos')->insert([
            [
                'nome' => 'Root'
            ],
            [
                'nome' => 'Administrador'
            ],
            [
                'nome' => 'Proponente De Evento'
            ],
            [
                'nome' => 'Proponente de Atividade'
            ],
            [
                'nome' => 'Usuário Comum'
            ]
        ]);
    }
}

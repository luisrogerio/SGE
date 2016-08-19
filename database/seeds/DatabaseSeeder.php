<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
//        factory('App\Models\Curso',10)->create();
//        factory('App\Models\AtividadeStatus', 10)->create();
        factory('App\Models\AtividadeTipo', 10)->create();
        factory('App\Models\Local', 10)->create();
//        //factory('App\Models\UsuarioGrupo', 10)->create();
//        factory('App\Models\UsuarioTipo', 10)->create();
        factory('App\Models\Aparencia', 6)->create();
        $this->call(UsuariosGruposSeeder::class);
        $this->call(UsuariosTiposSeeder::class);
        $this->call(AtividadesStatusSeeder::class);
    }
}

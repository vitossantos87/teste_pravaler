<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Carla Freitas",
            'email' => 'carla.freitas@sigie.com',
            'password' => bcrypt('carla123'),
            'cargo' => 'Diretora'
        ]);

        DB::table('users')->insert([
            'name' => "Pedro Silva",
            'email' => 'pedro.silva@sigie.com',
            'password' => bcrypt('pedro123'),
            'cargo' => 'Coordenador'
        ]);
    }
}

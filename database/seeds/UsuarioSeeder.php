<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::Create([
          'name' => 'juan',
          'email' => 'sebasnieto95@hotmail.com',
          'password' => Hash::make('12345'),
          'url' => 'pepes'
         // 'created_at' => date('Y-m-d H:i:s'),
         // 'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //$user->perfil()->create();


        $user = User::Create([
          'name' => 'juan2',
          'email' => 'sebasnieto952@hotmail.com',
          'password' => Hash::make('12345'),
          'url' => 'pepes',
         // 'created_at' => date('Y-m-d H:i:s'),
         // 'updated_at' => date('Y-m-d H:i:s'),
        ]);

        //$user->perfil()->create();

/*        DB::table('users')->insert([
          'name' => 'juan2',
          'email' => 'sebasnieto952@hotmail.com',
          'password' => Hash::make('12345'),
          'url' => 'pepes',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]);*/
    }
}

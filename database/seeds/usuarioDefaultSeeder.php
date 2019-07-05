<?php
use App\User;
use Illuminate\Database\Seeder;

class usuarioDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'primer_nombre'    => 'Administrador',
            'segundo_nombre'   => 'Administrador',
            'primer_apellido'  => 'Administrador',
            'segundo_apellido' => 'Administrador',
            'email'            => 'panonline503@gmail.com',
            'username'         => 'panaderialila',
    		'password'       => bcrypt('Admin2019$'),

        ]);

        User::create([
            'primer_nombre'    => 'Alejandro',
            'segundo_nombre'   => 'Stefano',
            'primer_apellido'  => 'Granados',
            'segundo_apellido' => 'Orellana',
            'email'            => 'estra@estra.com',
            'username'         => 'AleASGO20519',
    		'password'       => bcrypt('Estra2019$'),

        ]);

        User::create([
            'primer_nombre'    => 'Cesar',
            'segundo_nombre'   => 'Fernando',
            'primer_apellido'  => 'López',
            'segundo_apellido' => 'Hernandez',
            'email'            => 'tact@tact.com',
            'username'         => 'CesCFLH20519',
    		'password'       => bcrypt('Tact2019$'),

    	]);

        DB::table('role_user')->insert(['user_id' => '1' ,  'role_id'=>'1']);
        DB::table('role_user')->insert(['user_id' => '2' ,  'role_id'=>'2']);
        DB::table('role_user')->insert(['user_id' => '3' ,  'role_id'=>'3']);
    }
}

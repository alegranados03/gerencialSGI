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
    		'email'            => 'admin@admin.com',
    		'password'       => bcrypt('Admin2019$'),

        ]);

        User::create([
            'primer_nombre'    => 'Estrategico',
            'segundo_nombre'   => 'Estrategico',
            'primer_apellido'  => 'Estrategico',
            'segundo_apellido' => 'Estrategico',
    		'email'            => 'estra@estra.com',
    		'password'       => bcrypt('Estra2019$'),

        ]);

        User::create([
            'primer_nombre'    => 'Táctico',
            'segundo_nombre'   => 'Táctico',
            'primer_apellido'  => 'Táctico',
            'segundo_apellido' => 'Táctico',
    		'email'            => 'tact@tact.com',
    		'password'       => bcrypt('Tact2019$'),

    	]);

        DB::table('role_user')->insert(['user_id' => '1' ,  'role_id'=>'1']);
        DB::table('role_user')->insert(['user_id' => '2' ,  'role_id'=>'2']);
        DB::table('role_user')->insert(['user_id' => '3' ,  'role_id'=>'3']);
    }
}

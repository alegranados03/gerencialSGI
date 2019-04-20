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
    		'password'       => bcrypt('admin'),
    	
    	]);
        
        DB::table('role_user')->insert(['user_id' => '1' ,  'role_id'=>'1']);
    }
}

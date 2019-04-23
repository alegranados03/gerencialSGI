<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
class rolesDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
    		'name' 		     => 'Administrador',
    		'slug' 		     => 'admin',
            'description'    => 'Rol de Administrador',
    		'special' 	     => 'all-access',
    	]);
        Role::create([
            'name'           => 'Usuario Estrategico',
            'slug'           => 'estrategico',
            'description'    => 'Rol de Usuario Estrategico',
        ]);

        Role::create([
            'name'           => 'Usuario Táctico',
            'slug'           => 'tactico',
            'description'    => 'Rol de Usuario Táctico',
        ]);

        Role::create([
    		'name' 		     => 'Suspendido',
    		'slug' 		     => 'suspendido',
            'description'    => 'Sin acceso',
    		'special' 	     => 'no-access',
    	]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class permisosDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        //permisos de usuario estratégico
        Permission::create([
            'name'           => 'Inicio estratégico',
            'slug'           => 'home.estrategico',
            'description'    => 'Permiso para ver inicio estratégico',
        ]);

        //permisos de usuario táctico
        Permission::create([ 
            'name'           => 'Inicio táctico',
            'slug'           => 'home.tactico',
            'description'    => 'Permiso para ver inicio táctico',
        ]);
        //permisos de administrador
        

        // asignación de permisos al usuario estratégico
        DB::table('permission_role')->insert(['permission_id' => '1' ,  'role_id'=>'2']);
        DB::table('permission_role')->insert(['permission_id' => '1' ,  'role_id'=>'3']);
        // asignación de permisos al usuario táctico
        DB::table('permission_role')->insert(['permission_id' => '2' ,  'role_id'=>'3']);
        // asignación de permisos al usuario administrador
    }
}

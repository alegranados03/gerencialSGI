<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(rolesDefaultSeeder::class);
         $this->call(permisosDefaultSeeder::class);
         $this->call(usuarioDefaultSeeder::class);
    }
}

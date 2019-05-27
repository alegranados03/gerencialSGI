<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
class restauracion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restore {respaldo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restaura sobre un respaldo de la base de datos, el archivo debe encontrarse en la carpeta de backups generados por el sistema';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

       /* $this->process = new Process(sprintf(
           '%s',
           storage_path('backups/sql/screstore.bat')
        ));*/
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {  $option=$this->argument('respaldo');
       $routeMySQL='C:/XAMPP/mysql/bin';
       $user=env('DB_USERNAME', 'forge');
       $pass=env('DB_PASSWORD', '');
       $db=env('DB_DATABASE', '');
       $sourcePath=storage_path('backups\respaldos');
       $file='/'.$option;
       $cmd='cd '.$routeMySQL.' && mysql -u '.$user.' -p'.$pass.' '.$db.' < "'.$sourcePath.$file.'"';
        try { 
            exec($cmd);
            $this->info('El proceso de restauración del respaldo '.$option.' se realizó de forma exitosa');
        } catch (ProcessFailedException $exception) {
            $this->error('El proceso de restauración ha fallado. Seleccione un respaldo que se encuentre dentro de las carpetas del sistema');
        }
    }
}

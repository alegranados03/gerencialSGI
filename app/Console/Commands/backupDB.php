<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class backupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando inicia el proceso de backup de la base de datos gerencial';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->process = new Process(sprintf(
            
            /*'cd C:/XAMPP/mysql/bin', 'mysqldump -u%s -p%s %s --result_file=%s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.database'),
            storage_path('backups/backup.sql')*/
           '%s',
           storage_path('backups/sql/scbackup.bat')
        ));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {  $file='C:\xampp\htdocs\gerencialSGI\storage\backups\respaldos\backup_gerencialpanaderia__%date:/=%_%time:~0,2%-%time:~3,2%-%time:~6,2%.sql';
        $cmd='cd C:/XAMPP/mysql/bin && mysqldump -u panaderialila -pPanaderiaLilaGerencial gerencialpan --result_file="'.$file.'"';
        $cmd2='copy "'.$file.'" "C:\xampp\htdocs\gerencialSGI\storage\backups\respaldos\last_backup.sql" ';
        try {
            exec($cmd);
            exec($cmd2);

            $this->info('El backup se realizó de forma exitosa en: '.storage_path('backups'));
        } catch (ProcessFailedException $exception) {
            $this->error('El proceso de backup ha fallado.'.$exception);
        }
    }
}

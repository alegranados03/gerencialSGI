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
    protected $signature = 'db:restorelast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restaura la última copia de respaldo de la base de datos, el archivo debe llamarse last_backup.sql';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->process = new Process(sprintf(
           '%s',
           storage_path('backups/sql/screstore.bat')
        ));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->process->mustRun();

            $this->info('El proceso de restauración se realizó de forma exitosa');
        } catch (ProcessFailedException $exception) {
            $this->error('El proceso de restauración ha fallado.');
        }
    }
}

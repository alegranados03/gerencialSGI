<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
class execETL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:etl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando ejecuta el script en Python, 
    que extrae datos de la base transaccional y los inserta en la base gerencial';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->process = new Process(sprintf(
           'python %s',
           base_path('Python-ETL/script_ETL.py')
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

            $this->info('El ETL se ejecutó de forma exitosa en: '.base_path('Python-ETL'));
        } catch (ProcessFailedException $exception) {
            $this->error('El proceso de backup ha fallado.'.base_path('Python-ETL'));
        }
    }
}

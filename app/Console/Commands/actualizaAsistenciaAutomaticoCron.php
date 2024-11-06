<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Http\Controllers\Frontend\AsistenciaController;

class actualizaAsistenciaAutomaticoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'actualizaAsistenciaAutomatico:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta la funcion actualizaAsistenciaAutomatico';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		
		$hoy = Carbon::now()->format('Y-m-d');
		
        $controller = app()->make('App\Http\Controllers\Frontend\AsistenciaController');

        app()->call([$controller, 'asistencia_automatico'], [$hoy]);

        $this->info('SIGTP:Cron actualizaAsistenciaAutomatico Run successfully!');
    }
}

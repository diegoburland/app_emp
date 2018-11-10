<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Evaluacion_controller;
//use app\Http\Controllers\Evaluacion_controller;
//use Inggema\CRMAllus\Services\TechnicalServiceService;
use Illuminate\Support\Facades\Log;

class mailVerificationUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaw:notifications-mail-verification-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica el status del correo de cada usuario que aun no ha verificado el suyo';

    /**
     * @var Evaluacion_controller
     */

    private $evaluacion;

    public function __construct(Evaluacion_controller $evaluacionController)
    {
        parent::__construct();
        $this->evaluacion = $evaluacionController;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->evaluacion->verificarStatusCorreo();
    }
}

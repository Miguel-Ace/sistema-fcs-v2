<?php

namespace App\Console\Commands;

use App\Models\Expediente;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpedienteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expediente';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expedientes = Expediente::all();
        foreach ($expedientes as $key => $expediente) {
            $fecha = $expediente->fecha_nacimiento;

            if (strtotime($fecha) !== false) {
                // Calcular la edad con Carbon
                $fechaCarbon = Carbon::parse($fecha);
                $edad = $fechaCarbon->age; // Calcula la edad precisa

                $expediente->update(['edad' => $edad]);
            }
        }
    }
}

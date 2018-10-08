<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Mail\MailController;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $recipent;
    public function __construct( $recipent )
    {
        $this->recipent = $recipent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $correo = new MailController();
        // dd($this->recipent);
        $correo->costo_servicio_prestado($this->recipent);
    }
     public function failed(Exception $exception)
    {
       dd('a mamar que llegoo el polero');
    }
}

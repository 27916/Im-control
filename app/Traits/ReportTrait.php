<?php

namespace App\Traits;

use App\Mail\ReportsEmail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

trait ReportTrait
{
    public function generateReport(string $view)
    {
        $pdf = Pdf::loadView($view);
        return $pdf->stream();
    }

    public function sendReportEmail(string $to, ReportsEmail $email)
    {
        return Mail::to($to)
        ->queue($email);
        // return 'Correo enviado';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function generatePdf(Request $request)
    {
        $modalContent = $request->modalContent;

        $pdf = PDF::loadHTML($modalContent);

        return $pdf->download('patient_record.pdf');
    }
}
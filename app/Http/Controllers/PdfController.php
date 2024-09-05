<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf; // Import the PDF facade
use Illuminate\Http\Request;

class PdfController extends Controller
{
    /**
     * Generate a PDF and download it.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf()
    {
        // Data to pass to the view
        $data = [
            'title' => 'My PDF Title',
        ];

        // Load the view and pass data to it
        $pdf = Pdf::loadView('pdf_example', $data);

        // Return the PDF as a download
        return $pdf->download('document.pdf');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    function candidateFull(Request $request)  {
        // dd($request->data);
        // $pdf = PDF::loadView('pdf.view', $request->data);
        $data = ['title' => 'My PDF Title', 'content' => 'PDF Content'];
        $pdf = PDF::loadView('pdf.candidate_full', $data);

        // Return a downloadable PDF response
        return $pdf->download('candidate.pdf');
    }

    function candidatePartial(Request $request)  {
        // dd($request->data);
        // $pdf = PDF::loadView('pdf.view', $request->data);
        $data = ['title' => 'My PDF Title', 'content' => 'PDF Content'];
        $pdf = PDF::loadView('pdf.candidate_partial', $data);

        // Return a downloadable PDF response
        return $pdf->download('candidate.pdf');
    }
}

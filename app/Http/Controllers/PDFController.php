<?php

namespace NotiAPP\Http\Controllers;

use Illuminate\Http\Request;
use NotiAPP\Http\Requests;
use NotiAPP\Http\Controllers\Controller;

class PDFController extends Controller
{
    /**
     * Display a listing buget.
     *
     * 
     */
    public function bugetPDF()
    {
        //
         $date = date('Y-m-d');

         $view =  \View::make('pdf.budgetPDF', compact('date'))->render();
        
         $pdf = \App::make('dompdf.wrapper');

         $pdf->loadHTML($view);

        return $pdf->stream('PDF');
    }

}

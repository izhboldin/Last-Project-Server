<?php

namespace App\Http\Controllers;

use App\Events\PdfCreate;
use App\Jobs\CreatePdfForUser;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        CreatePdfForUser::dispatch($request->user());
    }
}

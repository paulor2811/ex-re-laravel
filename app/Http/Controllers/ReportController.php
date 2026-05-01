<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function contactsByCountry()
    {
        $report = Contact::select('country_code', DB::raw('count(*) as total'))
            ->groupBy('country_code')
            ->orderBy('total', 'desc')
            ->get();

        return view('reports.contacts_by_country', compact('report'));
    }
}

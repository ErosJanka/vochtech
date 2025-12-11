<?php

namespace App\Http\Controllers;

use App\Exports\CollaboratorsExport;
use App\Models\Collaborator;
use App\Models\Unit;
use Maatwebsite\Excel\Facades\Excel; // ADICIONE ESTA LINHA
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function collaborators(Request $request)
    {
        $query = Collaborator::query()->with('unit');
        
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        if ($request->filled('cnpj')) {
            $query->whereHas('unit', function ($q) use ($request) {
                $q->where('cnpj', 'like', '%' . $request->cnpj . '%');
            });
        }
        
        $collaborators = $query->paginate(15);
        
        return view('reports.collaborators', compact('collaborators'));
    }
    
    // ADICIONE ESTE MÉTODO
    public function export(Request $request)
    {
        return Excel::download(new CollaboratorsExport, 'collaborators.xlsx');
    }
}
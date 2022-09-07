<?php

namespace App\Http\Controllers\Package;

use App\Http\Controllers\Controller;
use App\Imports\PackageImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PackageImportController extends Controller
{
    public function importPackageTemplate(Request $request) 
    {
      
        $file = $request->file('file');
        
        Excel::import(new PackageImport, $file);
        
        return redirect('packages/index')->with('success', 'Archivo importado con Exito!');
    }
}

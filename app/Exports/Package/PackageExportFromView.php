<?php

namespace App\Exports\Reports;

use App\Http\Controllers\Export\Package\PackageExportController;
use Carbon\Carbon;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class PackageExportFromView implements FromView
{
    public $request;

    public function __construct($request)
    {
        $this->$request = $request;
    }

    public function view(): View
    {
        $report = new PackageExportController();
        
        return $report->packagesExport();
    }

    

    public function setter($request){
        $this->request = $request;
     }

    
}

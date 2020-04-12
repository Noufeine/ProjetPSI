<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ExportIndividus;
use Maatwebsite\Excel\Facades\Excel;
use DB;



class ExportIndividusController extends Controller
{
  public function afficher()
    {
        return view('export-individus');
    }

  public function export()
  {
   
   
    
        return Excel::download(new ExportIndividus, 'ListeIndividus.xls');
    


    return view('accueil');

    }
}

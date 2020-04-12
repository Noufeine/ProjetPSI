<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportGroupes;
use DB;


class ExportGroupesController extends Controller
{
  public function afficher()
  {
    return view('export-groupes');
  }
  
  public function export()
  {
    return Excel::download(new ExportGroupes, 'ListeGroupes.xls');
    return view('accueil');
  }
}

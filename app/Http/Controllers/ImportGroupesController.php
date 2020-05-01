<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportGroupes;
use App\Http\Controllers\Controller;




class ImportGroupesController extends Controller
{
  public function afficher()
    {
        return view('import-groupes');
    }

  public function import(Request $request)
  {
    $request->validate([
      'import_file' => 'required|mimes:xls,xlsx'
    ]);

    Excel::import(new ImportGroupes, request()->file('import_file'));

    header ('Location: /liste-groupes');
    exit();

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ImportFormations;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class ImportFormationsController extends Controller
{

  public function afficher()
  {
    return view('import-formations');
  }

  public function import(Request $request)
  {
    $request->validate([
      'import_file' => 'required|mimes:xls,xlsx'
    ]);

    Excel::import(new ImportFormations, request()->file('import_file'));

    return view('welcome');

    }

}

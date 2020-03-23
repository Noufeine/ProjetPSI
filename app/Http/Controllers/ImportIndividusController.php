<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ImportIndividus;
use Maatwebsite\Excel\Facades\Excel;
use DB;


class ImportIndividusController extends Controller
{
  public function afficher()
    {
        return view('import-individus');
    }

  public function import(Request $request)
  {
    $request->validate([
      'import_file' => 'required|mimes:xls,xlsx'
    ]);

    Excel::import(new ImportIndividus, request()->file('import_file'));

    return view('welcome');

    }
}

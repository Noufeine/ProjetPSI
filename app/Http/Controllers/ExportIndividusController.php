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
	  	$nom_fichier=request('nom_fichier');
	  	if(!isset($nom_fichier))$nom_fichier = "Individu";
	    $nom_fichier.=".xls";
	    return Excel::download(new ExportIndividus, $nom_fichier);
	    return view('accueil');
	}
}

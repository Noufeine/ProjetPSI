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
		$listegroupes = DB::table('groupe')

           ->get();

        $listeannees = DB::table('groupe_individu')
           ->select('annee')
           ->distinct()
           ->get(); 

		return view('export-groupes',compact('listegroupes','listeannees'));
	}
	public function export()
	{
		$nom_fichier=request('nom_fichier');
		if(!isset($nom_fichier))$nom_fichier = "Groupe";
	    $nom_fichier.=".xls";
	    return Excel::download(new ExportGroupes, $nom_fichier);
	    return view('accueil');
	}
}

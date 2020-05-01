<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class SupprimerGroupeController extends Controller
{

	public function lister()
	{
	
	/*$groupes = DB::table('groupe')
			   	->where('id_groupe', $variable)
				->get();
*/

	$listegroupes = DB::table('groupe')

				   ->get();


	$listeannees = DB::table('groupe_individu')
				   ->select('annee')
				   ->distinct()
				   ->get();


    $listeindividu = DB::table('groupe')
    					//->where('id_groupe', $groupe)
    					->join('groupe_individu','groupe_individu.fid_groupe','=','groupe.id_groupe')
    					->join('individu','individu.id_individu','=','groupe_individu.fid_individu')
    					->select('id_groupe','id_individu','nom_individu','prenom_individu','annee')
	        			->get();
    

    return view('supprimer',compact('listeindividu','listegroupes','listeannees'));

	}

	public function retirer()
{	

	DB::table('groupe_individu')
	 ->where('fid_groupe',request('groupe1') )
	 ->delete();
	
	DB::table('groupe')
	 ->where('id_groupe',request('groupe1'))
	 ->delete();

	header ('Location: /supprimer');
	exit();

}

	


}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;


class InscrireIndividusController extends Controller
{

	public function inscrire()
	{
	
	$listegroupes = DB::table('groupe')

				   ->get();

    $datas = DB::table('groupe_individu')
    		->select('fid_individu')
	        ->get();
    
    foreach ($datas as $data) {
                $Ingroupe[] = $data->fid_individu;
            }

    $data2 = DB::table('individu')
               ->where('fid_type_individu', 2)
        	   ->whereNotIn('id_individu', $Ingroupe)
        	   ->get();

    return view('inscrire-individus',compact('data2','listegroupes'));

	}

	public function ajouter()
{	
	for($i=0;$i<count(request('choix'));$i++)
	{
	 DB::table('groupe_individu')
	->updateOrInsert(['fid_groupe' => request('groupe'),
	'fid_individu' => request('choix')[$i], 
	'annee' => request('annee')]);
	}

	return view('/accueil');

}

	


}
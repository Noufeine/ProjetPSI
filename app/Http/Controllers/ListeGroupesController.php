<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ListeGroupesController extends Controller
{
  
  public function lister()
  {
  


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
    

    return view('liste-groupes',compact('listeindividu','listegroupes','listeannees'));

  }

}


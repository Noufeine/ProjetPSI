<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CreerGroupeController extends Controller
{

  
  public function creer(Request $request)
  {

 
    //insertion dans la table Groupes
    DB::table('groupe')
      ->updateOrInsert([
      'fid_formation' => request('formation'),
      'fid_modalite' => request('modalite'),
      'libelle_groupe' => request('libelle'),
      'fid_niveau' => request('niveau')]);

 

  header ('Location: /creer-groupe');
  exit();
  }





  public function formulaire()
  {
    //je recupere toutes les formations, avec leurs niveaux et leurs composantes
    $formations=DB::table('formation')
    ->get();
    $modalites=DB::table('modalite')
    ->get();
    $niveaux =DB::table('niveau')
    ->get();

    $groupe=DB::table('groupe')
    ->get();

    $annee=DB::table('groupe_individu')
           ->select('annee')
           ->distinct()
           ->get();
    

    return view('creer-groupe',compact('formations','modalites','niveaux','groupe','annee'));
  }
}

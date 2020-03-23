<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ListeGroupesController extends Controller
{
    public function liste(){
      $groupes=DB::table('Groupe')
      ->join('Modalite', 'Modalite.id_modalite', '=', 'Groupe.fid_modalite')
      ->join('Formation', 'Formation.id_formation', '=', 'Groupe.fid_formation')
      ->join('Composante', 'Composante.id_composante', '=', 'Formation.fid_composante')
      ->join('Niveau', 'Niveau.id_niveau', '=', 'Formation.fid_niveau')
      ->get();

      return view('liste-groupes',compact('groupes'));
    }
}

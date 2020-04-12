<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CreerSeanceGroupeController extends Controller
{


    public function afficher(){
      $liste_seance = DB::table('seance')->get();
      $liste_cours = DB::table('cours')->get();
      $liste_groupe = DB::table('groupe')->get();
      $liste_individu = DB::table('individu')->get();
      return view('creer-groupe-seance',compact('liste_seance','liste_cours','liste_groupe','liste_individu'));
      }


public function creer(){

DB::table('seance_groupe')->insert(
    [
    'fid_seance' => request('fid_seance'),
    'fid_groupe' => request('fid_groupe'),
    'fid_cours' => request('fid_cours'),
    'fid_individu' => request('fid_individu'),
    'date_debut_seance' => request('date_debut_seance'),
    'date_fin_seance' => request('date_fin_seance')
    ]
  );

  $liste_seance_groupe = DB::table('seance_groupe')
    ->join('seance','seance.id_seance','=','seance_groupe.fid_seance')
    ->join('groupe','groupe.id_groupe','=','seance_groupe.fid_groupe')
    ->join('cours','cours.id_cours','=','seance_groupe.fid_cours')
    ->join('individu','individu.id_individu','=','seance_groupe.fid_individu')
    ->get();
    return view('liste-seance-groupe',compact('liste_seance_groupe'));
}

public function liste(){
  $liste_seance_groupe = DB::table('seance_groupe')
    ->join('seance','seance.id_seance','=','seance_groupe.fid_seance')
    ->join('groupe','groupe.id_groupe','=','seance_groupe.fid_groupe')
    ->join('cours','cours.id_cours','=','seance_groupe.fid_cours')
    ->join('individu','individu.id_individu','=','seance_groupe.fid_individu')
    ->get();
    return view('liste-seance-groupe',compact('liste_seance_groupe'));
  }
}

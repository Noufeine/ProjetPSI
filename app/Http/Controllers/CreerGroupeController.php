<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CreerGroupeController extends Controller
{
  public function creer(Request $request)
  {

    //selection de l'identifiant de la formation
    $id_formation=DB::table('Formation')
    ->join('Composante', 'Composante.id_composante', '=', 'Formation.fid_composante')
    ->join('Niveau', 'Niveau.id_niveau', '=', 'Formation.fid_niveau')
    ->where('Composante.code_composante',request('ufr'))
    ->where('Niveau.code_niveau',request('niveau'))
    ->where('Formation.libelle_formation',request('formation'))
    ->take(1)
    ->value('Formation.id_formation');

    //selection de l'identifiant de la modalite
    $id_modalite=DB::table('Modalite')
    ->where('code_modalite',request('modalite'))
    ->take(1)
    ->value('id_modalite');

    //insertion dans la table Groupes
    DB::table('Groupe')
      ->updateOrInsert(['annee' => request('annee'),
      'fid_formation' => $id_formation,
      'fid_modalite' => $id_modalite],
      ['annee' => request('annee'),
      'fid_formation' => $id_formation,
      'fid_modalite' => $id_modalite]);

    //liste des groupes pour envoyer à la page liste-groupes
    $groupes=DB::table('Groupe')
    ->join('Modalite', 'Modalite.id_modalite', '=', 'Groupe.fid_modalite')
    ->join('Formation', 'Formation.id_formation', '=', 'Groupe.fid_formation')
    ->join('Composante', 'Composante.id_composante', '=', 'Formation.fid_composante')
    ->join('Niveau', 'Niveau.id_niveau', '=', 'Formation.fid_niveau')
    ->orderBy('Composante.code_composante')
    ->get();


    return view('liste-groupes',compact('groupes'));
  }

  public function formulaire()
  {
    //je recupere toutes les formations, avec leurs niveaux et leurs composantes
    $formations=DB::table('Formation')
    ->join('Composante', 'Composante.id_composante', '=', 'Formation.fid_composante')
    ->join('Niveau', 'Niveau.id_niveau', '=', 'Formation.fid_niveau')
    ->get();

    return view('creer-groupe',compact('formations'));
  }
}

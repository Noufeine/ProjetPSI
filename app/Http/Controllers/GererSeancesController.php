<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GererSeancesController extends Controller
{
  public function afficher()
  {
    setlocale(LC_TIME, 'fr_FR');
    date_default_timezone_set('Europe/Paris');

    //je recupere la date du jour
    $date_du_jour=date_create(request('date_du_jour'));
    $j= date_format($date_du_jour,'w');
    $diff=7-$j;

    if($j==0){
      $debutSemaine=utf8_encode(strftime('%Y-%m-%d 00:00:00', mktime(0, 0, 0, date_format($date_du_jour,'m'), date_format($date_du_jour,'d')-6, date_format($date_du_jour,'y'))));
      $finSemaine=utf8_encode(strftime('%Y-%m-%d 23:59:59', mktime(0, 0, 0, date_format($date_du_jour,'m'), date_format($date_du_jour,'d'), date_format($date_du_jour,'y'))));
    }
    else{
      $debutSemaine=utf8_encode(strftime('%Y-%m-%d 00:00:00', mktime(0, 0, 0, date_format($date_du_jour,'m'), date_format($date_du_jour,'d')-$j+1, date_format($date_du_jour,'y'))));
      $finSemaine=utf8_encode(strftime('%Y-%m-%d 23:59:59', mktime(0, 0, 0, date_format($date_du_jour,'m'), date_format($date_du_jour,'d')+$diff, date_format($date_du_jour,'y'))));
    }

    $cours=DB::table('cours')->get();

    $salles=DB::table('salle')
    ->JOIN('seance','seance.fid_salle','=','salle.id_salle')
    ->orderBy('numero_salle')
    ->get();

    $groupes=DB::table('groupe')->get();

    $enseignants=DB::table('individu')
    ->WHERE('annuaire','=',1)
    ->get();

    $liste_seances_groupes=DB::table('salle')
    ->JOIN ('seance','seance.fid_salle','=','salle.id_salle')
    ->JOIN ('type_seance','seance.fid_type_seance','=','type_seance.id_type_seance')
    ->JOIN ('seance_groupe','seance_groupe.fid_seance','=','seance.id_seance')
    ->JOIN ('cours','cours.id_cours','=','seance_groupe.fid_cours')
    ->JOIN ('individu','individu.id_individu','=','seance_groupe.fid_individu')
    ->JOIN ('groupe','groupe.id_groupe','=','seance_groupe.fid_groupe')
    ->whereBetween('date_debut_seance', [$debutSemaine, $finSemaine])
    ->orderBy('salle.numero_salle','desc')
    ->orderBy('date_debut_seance','asc')
    ->get();


    return view('gerer-seances',compact('liste_seances_groupes','cours','salles','groupes','enseignants'));
  }

  public function creer()
  {
    //pour la création
    if(!empty(request('creer'))){


    //je recupere l'id de la seance grace au numéro de la salles
    $id_seance=DB::table('seance')
    ->WHERE('fid_salle','=',request('id_salle'))
    ->take(1)
    ->value('id_seance');

    $num_salle=DB::table('salle')
    ->where('id_salle',request('id_salle'))
    ->take(1)
    ->value('numero_salle');
    $date_du_jour=request('date_seance');

    //je recupere puis concatene les dates (date debut & date fin)
    $date_debut=request('date_seance')." ".request('heure_debut_seance');
    $date_fin=request('date_seance')." ".request('heure_fin_seance');

    //je verifie si cette page horraire a été deja reservée
    $nb=DB::table('seance_groupe')
    ->where('fid_seance','=',$id_seance)
    ->whereBetween('date_debut_seance', [$date_debut, $date_fin])
    ->whereNotBetween('date_fin_seance', [$date_debut, $date_fin])
    ->count();

    if($nb==0){
      //j'enregistre dans la BDD, dans la table seance_groupe
      DB::table('seance_groupe')
      ->updateOrInsert(['fid_seance'=>$id_seance,'fid_groupe'=>request('id_groupe'),'fid_individu'=>request('id_enseignant'),
      'fid_cours'=>request('id_cours'),'date_debut_seance'=>$date_debut,'date_fin_seance'=>$date_fin],
      ['fid_seance'=>$id_seance,'fid_groupe'=>request('id_groupe'),'fid_individu'=>request('id_enseignant'),
      'fid_cours'=>request('id_cours'),'date_debut_seance'=>$date_debut,'date_fin_seance'=>$date_fin]);

      header ('Location: ?date_du_jour='.$date_du_jour.'&msg=creer_seance&salle='.$num_salle.'');
      exit();
    }
    else{
      header ('Location: ?date_du_jour='.$date_du_jour.'&msg=error_creer_seance&salle='.$num_salle.'');
      exit();
    }

    }

    //pour la modification
    if(!empty(request('modifier'))){
      //je recupere la date et les heures
      $date=request('date_seance');
      $heure_debut=request('heure_debut_seance');
      $heure_fin=request('heure_fin_seance');
      $date_debut=$date." ".$heure_debut;
      $date_fin=$date." ".$heure_fin;
      //je recupere la seance
      $id_seance=DB::table('seance')
      ->join('salle','seance.fid_salle','=','salle.id_salle')
      ->WHERE('salle.numero_salle','=',request('numero_salle'))
      ->take(1)
      ->value('seance.id_seance');

      DB::table('seance_groupe')
          ->where('fid_groupe', request('fid_groupe'))
          ->where('fid_cours', request('fid_cours'))
          ->where('fid_individu', request('fid_individu'))
          ->update(
            ['date_debut_seance' => $date_debut,
            'date_fin_seance' => $date_fin,
            'fid_seance'=> $id_seance]);
      $date_du_jour=request('date_seance');
      $salle=request('numero_salle');
      header ('Location: ?date_du_jour='.$date_du_jour.'&msg=modifie_seance&salle='.$salle.'');
      exit();
    }

    //pour la suppression
     if(!empty(request('supprimer'))){

       DB::table('seance_groupe')
       ->where('fid_seance', '=', request('fid_seance'))
       ->where('fid_groupe', '=', request('fid_groupe'))
       ->where('fid_individu', '=', request('fid_individu'))
       ->where('fid_cours', '=', request('fid_cours'))
       ->where('date_debut_seance', '=', request('date_debut_seance'))
       ->where('date_fin_seance', '=', request('date_fin_seance'))
       ->delete();

       $salle=DB::table('salle')
       ->JOIN('seance','fid_salle','=','id_salle')
       ->WHERE('id_seance',request('fid_seance'))
       ->take(1)
       ->value('numero_salle');

      $date_du_jour=request('date_debut_seance');
      $d="";
       for ($i=0; $i < 10; $i++) {
         $d=$d.$date_du_jour[$i];
       }
       header ('Location: ?date_du_jour='.$d.'&msg=supprime_seance&salle='.$salle.'');
       exit();
     }
  }

}

<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;


class ImportGroupes implements ToModel
{
  /**
  * @param array $row
  *
  * @return \Illuminate\Database\Eloquent\Model|null
  */
  /*
  //prendre le nom
  public function formation($nomGroupe){
    $formation="";
    $i=3;
    while ($i < count($nomGroupe) || $nomGroupe[$i]!="_") {
      $formation=$niveau.$nomGroupe[$i];
      $i++;
    }
    return $formation;
  }

  //prendre la voie
  public function voie($nomGroupe){
    $voie="";
    $nb_voie=0;
    for ($i=0; $i < count($nomGroupe); $i++) {
      if($nomGroupe[$i]=="_"){
        $nb_voie++;
      }
    }
    if($nb_voie==1) $voie="FI";
    else{
      $i=count($nomGroupe)-1;
      while ($nomGroupe[$i]!="_") {
        $voie=$nomGroupe[$i].$voie;
        $i--;
      }
    }
    return $voie;
  }

*/


  public function model(array $row)
  {

      //ne pas prendre la première ligne
      if(@$row[0]!='NOM' && @$row[2]==2){

        $id_groupe=DB::table('Groupe')
        ->where('libelle_groupe',@$row[4])
        ->take(1)
        ->value('id_groupe');

        DB::table('individu')->updateOrInsert(['id_individu' => @$row[3]],
        ['id_individu' => @$row[3], 'nom_individu' => @$row[0], 'prenom_individu' => @$row[1],
        'fid_type_individu'=>@$row[2]]);


        DB::table('Groupe_Individu')->updateOrInsert(['fid_groupe'=>$id_groupe,
        'fid_individu'=>@$row[3],'annee'=>@$row[6]],['fid_groupe'=>$id_groupe,
        'fid_individu'=>@$row[3],'annee'=>@$row[6]]);

        }

    }
}

<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

class ImportIndividus implements ToModel
{
  /**
  * @param array $row
  *
  * @return \Illuminate\Database\Eloquent\Model|null
  */


  public function model(array $row)
  {
      //ne pas prendre la première ligne
      if(@$row[0]!='NOM'){

        DB::table('individu')->updateOrInsert(['id_individu' => @$row[3]],
        ['id_individu' => @$row[3], 'nom_individu' => @$row[0], 'prenom_individu' => @$row[1]]);

        }
    }
}

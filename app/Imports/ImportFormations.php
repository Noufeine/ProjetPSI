<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;


class ImportFormations implements ToModel
{
  /**
  * @param array $row
  *
  * @return \Illuminate\Database\Eloquent\Model|null
  */

    public function model(array $row)
    {
      //ne pas prendre la première ligne
      if(@$row[0]!='Formation'){


        //insertion de l'Ufr
        DB::table('Composante')->updateOrInsert(['code_composante' => @$row[4]],
        ['code_composante' => @$row[4], 'libelle_composante' => @$row[3]]);

        //recupération de l'id de l'ufr
        $id_ufr=DB::table('Composante')
        ->where('code_composante',@$row[4])
        ->take(1)
        ->value('id_composante');

        //insertion du niveau

        switch (@$row[2]) {
          case 'L1':
            $niveau='Licence 1';
            break;
          case 'L2':
            $niveau='Licence 2';
            break;
          case 'L3':
            $niveau='Licence 3';
            break;
          case 'M1':
            $niveau='Master 1';
            break;
          case 'M2':
            $niveau='Master 2';
        }


        DB::table('Niveau')->updateOrInsert(['code_niveau' => @$row[2]],
        ['code_niveau' => @$row[2], 'libelle_niveau' => $niveau]);


        //recupération de l'id du niveau
        $id_niveau=DB::table('Niveau')
        ->where('code_niveau',@$row[2])
        ->take(1)
        ->value('id_niveau');

        //insertion dans la table Formation
        DB::table('Formation')->updateOrInsert(['code_formation' =>@$row[1] ,'fid_composante' => $id_ufr,'fid_niveau' => $id_niveau ],
        ['code_formation' =>@$row[1],'libelle_formation'=> @$row[0],'fid_composante' => $id_ufr,'fid_niveau' => $id_niveau ]);
        }
    }
}

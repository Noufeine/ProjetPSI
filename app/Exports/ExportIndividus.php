<?php


namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;




class ExportIndividus implements FromCollection, WithHeadings
{
  
    public function collection()
    {

      $resultat= DB::table('individu')
                  
                  ->leftjoin('groupe_individu','groupe_individu.fid_individu','=','individu.id_individu')
                  ->leftjoin('groupe','groupe.id_groupe','=','groupe_individu.fid_groupe')
                  ->leftjoin('niveau','niveau.id_niveau','=','groupe.fid_niveau')
                  ->select('nom_individu','prenom_individu','annuaire','id_individu','libelle_groupe','code_niveau','annee')
                  ->get();

      	return $resultat;    }




public function headings():array{

      return [
        'NOM',
        'PRENOM',
        'ANNUAIRE',
        'NUMERO',
        'GROUPE',
        'NIVEAU',
        'ANNEE',
      ];
    }

}
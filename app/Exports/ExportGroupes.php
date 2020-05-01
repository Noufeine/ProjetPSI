<?php


namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;




class ExportGroupes implements FromCollection, WithHeadings
{
    public function collection()
    {
      $resultat=DB::table('Groupe')
          ->join('Niveau','Niveau.id_niveau','=','Groupe.fid_niveau')
          ->join('Groupe_individu','Groupe.id_groupe','=','Groupe_Individu.fid_groupe')
          ->join('individu','individu.id_individu','=','Groupe_Individu.fid_individu')
          ->where('Groupe_Individu.fid_groupe',request('groupe'))
          ->where('Groupe_Individu.annee',request('annee'))

          ->select('libelle_groupe','nom_individu','prenom_individu','annuaire','id_individu','code_niveau','annee')

          ->get();




      return $resultat;
    }

public function headings():array{
      return [
        'GROUPE',
        'NOM',
        'PRENOM',
        'ANNUAIRE',
        'NUMERO',
        'NIVEAU',
        'ANNEE',
      ];
    }
}

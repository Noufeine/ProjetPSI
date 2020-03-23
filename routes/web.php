<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

return view('welcome');
});

Route::get('/ajout',function(){
return view('ajout');
});

Route::post('/seance',function(){

//insertion table simple

   DB::table('salle')->insert(
    [
      'numero_salle' => request('numero_salle'),
      'capacite_salle' => request('capacite_salle'),
      'nb_postes' => request('nb_postes'),
      'projecteur' => request('projecteur')
    ]
  );

  DB::table('type_seance')->insert(
    [
      'libelle_type_seance' => request('libelle_type_seance')
    ]
  );

  DB::table('cours')->insert(
    [
      'libelle_cours' => request('libelle_cours')
    ]
  );

  DB::table('composante')->insert(
    [
      'libelle_composante' => request('libelle_composante')
    ]
  );

  DB::table('modalite')->insert(
    [
      'libelle_modalite' => request('libelle_modalite')
    ]
  );

  DB::table('type_individu')->updateOrInsert(
    [
      'id_type_individu' => request('id_type_individu'),
      'libelle_type_individu' => request('libelle_type_individu')

    ]
  );

  DB::table('niveau')->insert(
    [
      'libelle_niveau' => request('libelle_niveau')
    ]
  );


  /**********************individu ********************************/

$fid_type_individu = DB::table('type_individu')
->where('id_type_individu',request('id_type_individu'))
->take(1)
->value('id_type_individu');

  DB::table('individu')->updateOrInsert(
    [
      'id_individu' => request('id_individu'),
      'annuaire' => request('annuaire'),
      'nom_individu' => request('nom_individu'),
      'prenom_individu' => request('prenom_individu'),
      'mail_individu' => request('mail_individu'),
      'tel_individu' => request('tel_individu'),
      'fid_type_individu' => $fid_type_individu
    ]
  );

  /*******************************************************/

  /*****table d'association ****/

  /***** seance *****/

  $fid_salle=DB::table('salle')
  ->where('numero_salle', request('numero_salle'))
  ->take(1)
  ->value('id_salle');

  $fid_type_seance=DB::table('type_seance')
  ->where('libelle_type_seance',request('libelle_type_seance'))
  ->take(1)
  ->value('id_type_seance');

  DB::table('seance')->insert(
    [
      'fid_salle' => $fid_salle,
      'fid_type_seance' => $fid_type_seance
    ]
  );

  /******************* Formation ********************/

  $fid_composante=DB::table('composante')
  ->where('libelle_composante', request('libelle_composante'))
  ->take(1)
  ->value('id_composante');

  DB::table('formation')->insert(
    [
      'libelle_formation' => request('libelle_formation'),
      'fid_composante' => $fid_composante
    ]
  );
/*****************************************************/


/******************* groupe ******************/

$fid_niveau=DB::table('niveau')
->where('libelle_niveau', request('libelle_niveau'))
->take(1)
->value('id_niveau');

$fid_formation=DB::table('formation')
->where('libelle_formation',request('libelle_formation'))
->take(1)
->value('id_formation');

$fid_modalite=DB::table('modalite')
->where('libelle_modalite',request('libelle_modalite'))
->take(1)
->value('id_modalite');

DB::table('groupe')->insert(
  [
    'fid_niveau' => $fid_niveau,
    'fid_formation' => $fid_formation,
    'fid_modalite' => $fid_modalite,
    'libelle_groupe' => request('libelle_groupe'),
    'annee' => request('annee')
  ]
);

/***************************************************************/

/************************ GROUPE INDIVIDU *****************************/

$fid_individu=DB::table('individu')
->where('id_individu',request('id_individu'))
->take(1)
->value('id_individu');

$fid_groupe=DB::table('groupe')
->where('libelle_groupe',request('libelle_groupe'))
->take(1)
->value('id_groupe');

DB::table('groupe_individu')->insert(
  [
    'fid_individu' => $fid_individu,
    'fid_groupe' => $fid_groupe,
  ]
);

/*******************************************************************************/

/********************************** SEANCE GROUPE *******************************/



  $fid_seance=DB::table('seance')
  ->where('fid_salle',$fid_salle)
  ->where('fid_type_seance', $fid_type_seance)
  ->take(1)
  ->value('id_seance');

  $fid_cours=DB::table('cours')
  ->where('libelle_cours',request('libelle_cours'))
  ->take(1)
  ->value('id_cours');



DB::table('seance_groupe')->insert(
  [
    'date_debut_seance' => request('date_debut_seance'),
    'date_fin_seance' => request('date_fin_seance'),
    'fid_individu' => $fid_individu, // deja recuperer ds groupe individu
    'fid_groupe' => $fid_groupe, // deja recupérer ds groupe individu
    'fid_cours' => $fid_cours,
    'fid_seance' => $fid_seance
  ]
);

/******************************************************************************/

  return 'formulaire reçu';
});

Route::get('/liste',function(){
$liste_seance = DB::table('seance')
->join('salle','salle.id_salle','=','seance.fid_salle')
->join('type_seance','type_seance.id_type_seance','=','seance.fid_type_seance')
->get();

$liste_groupe_individu = DB::table('groupe_individu')
->join('groupe','groupe.id_groupe','=','groupe_individu.fid_groupe')
->join('individu','individu.id_individu','=','groupe_individu.fid_individu')
->get();

$liste_groupe = DB::table("groupe")
->join('formation','formation.id_formation','=','groupe.fid_formation')
->join('modalite','modalite.id_modalite','=','groupe.fid_modalite')
->join('niveau','niveau.id_niveau','=','groupe.fid_niveau')
->get();

$liste_cours = DB::table('cours')->get();




return view('liste',compact('liste_seance','liste_groupe_individu','liste_groupe','liste_cours'));
});

/*
Route::get('/modification',function(){
  return view('modifier');
});

Route::post('/modification',function(){
 DB::table('salle')
  ->where('numero_salle',request('numero_salle'))
  ->update(
    [
      'capacite_salle' => request('capacite_salle'),
      'nb_postes' => request('nb_postes'),
      'projecteur' => request('projecteur')
    ]
);

return 'formulaire reçu';
});*/


/* A revoir */



/*
Route::post('/modification',function(){
 DB::table('seance')
 ->join('salle','seance.id_seance','salle.id_salle')
 ->join('type_seance','seance.id_seance','type_seance.libelle_type_seance')
 ->where('numero_salle',request('numero_salle'))
 ->update(
    [
      'capacite_salle' => request('capacite_salle'),
      'nb_postes' => request('nb_postes'),
      'projecteur' => request('projecteur'),
      'libelle_type_seance' =>request('libelle_type_seance')
    ]
);

return 'formulaire reçu';

});
*/
/*
Route::get('/', function () {
return view('acceuil');
});*/

//importation des individus (Nfn)
Route::GET('import-individus','ImportIndividusController@afficher');
Route::POST('import-individus','ImportIndividusController@import');

//formulaire de creation d'un groupe (Nfn)
Route::GET('creer-groupe','CreerGroupeController@formulaire');

//Creation d'un groupe (Nfn)
Route::POST('liste-groupes','CreerGroupeController@creer');

//affichage (liste) des groupes
Route::GET('liste-groupes','ListeGroupesController@liste');

//importation des formations (Nfn)
Route::GET('import-formations','ImportFormationsController@afficher');
Route::POST('import-formations','ImportFormationsController@import');

<html>
<head>

      <title> liste des seance </title>

</head>

<body>

<h1> La liste des types de seance </h1>
<div>
@foreach($liste_seance as $seance)
<li>  numero de salle : {{ $seance->numero_salle }}</li>
<li> capacite de la salle : {{  $seance->capacite_salle }}</li>
<li> nombre de postes : {{ $seance->nb_postes }}</li>
<li> nombre de projecteur : {{  $seance->projecteur }}</li>
<li> type de seance : {{ $seance->libelle_type_seance }}</li>
@endforeach
</div>

<h1> La liste  d'individu </h1>

<div>
@foreach($liste_groupe_individu as $groupe_individu)
<li> annuaire : {{ $groupe_individu->annuaire }}</li>
<li> nom : {{ $groupe_individu->nom_individu }}</li>
<li> prenom : {{ $groupe_individu->prenom_individu }}</li>
<li> mail : {{ $groupe_individu->mail_individu }}</li>
<li> tel : {{ $groupe_individu->tel_individu }}</li>
<li> type individu : {{ $groupe_individu->fid_type_individu}}</li>
</div>
@endforeach



<h1> Liste des groupes </h1>
<div>
@foreach($liste_groupe as $groupe)
<li> formation : {{ $groupe->libelle_formation }}</li>
<li> composante : {{ $groupe->fid_composante }}</li>
<li> groupe : {{ $groupe->libelle_groupe }}</li>
<li> annee : {{ $groupe->annee}}</li>
<li> modalite : {{ $groupe->libelle_modalite }}</li>
<li> niveau : {{ $groupe->libelle_niveau }}</li>
@endforeach

</div>

<h1> liste des cours </h1>
<div>
@foreach($liste_cours as $cours)
<li> nom du cours : {{ $cours->libelle_cours }}</li>
@endforeach

</div>
</body>
</html>

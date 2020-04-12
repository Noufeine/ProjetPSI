
@extends('layout')

@section('contenu')

<br>
<br>
<br>
<div class="card mx-auto " style="width: 50rem;">
<div class="card-body">
<h1> Liste seance </h1>

<div>
@foreach($liste_seance_groupe as $seance_groupe)
<li>  numero seance : {{ $seance_groupe->fid_seance }}</li>
<li> numero groupe : {{  $seance_groupe->fid_groupe }}   libelle groupe  {{ $seance_groupe->libelle_groupe}}</li>
<li> numero individu : {{ $seance_groupe->fid_individu }}  nom individu  {{ $seance_groupe->nom_individu}}</li>
<li> numero cours : {{  $seance_groupe->fid_cours }} libelle cours  {{ $seance_groupe->libelle_cours}}</li>
<li> date de debut de seance : {{ $seance_groupe ->date_debut_seance }}</li>
<li> date de fin de seance : {{ $seance_groupe ->date_fin_seance }}</li>
<br>
@endforeach
</div>

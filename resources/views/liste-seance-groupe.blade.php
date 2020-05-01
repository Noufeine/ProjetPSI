
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

<form action="{{ url('liste-seance-groupe') }}" method="POST" enctype="multipart/form-data">
    @csrf
<div>
<li>  numero seance : {{ $seance_groupe->fid_seance }}</li>
<li> numero groupe : {{  $seance_groupe->fid_groupe }}   libelle groupe  {{ $seance_groupe->libelle_groupe}}</li>
<li> numero individu : {{ $seance_groupe->fid_individu }}  nom individu  {{ $seance_groupe->nom_individu}}</li>
<li> numero cours : {{  $seance_groupe->fid_cours }} libelle cours  {{ $seance_groupe->libelle_cours}}</li>
<li> date de debut de seance : {{ $seance_groupe ->date_debut_seance }}</li>
<li> date de fin de seance : {{ $seance_groupe ->date_fin_seance }}</li>
<br>
<input type="checkbox" class="btn btn-success" name="fid_seance" value= "{{ $seance_groupe->fid_seance }}">
<input type="submit" class="btn btn-success" value="suprimmer">
@endforeach
</div>
<br>
<div align="center">

<input type="checkbox" class="btn btn-success" name="fid_seance" value= "0">
<input type="submit" class="btn btn-success" value="modifier">
</form>
</div>
@endsection

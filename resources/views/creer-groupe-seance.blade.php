@extends('layout')

@section('contenu')
<br>
<br>
<br>
<div class="card mx-auto " style="width: 50rem;">
<div class="card-body">
<h1> Seance Groupe </h1>
<form action="creer-groupe-seance" method="post">
{{ csrf_field() }}
<table>
<div>
<label for="seance"> La seance </label>
<select class= "form-control" name="fid_seance">
@foreach ($liste_seance as $seance)
<option value  = "{{$seance->id_seance}}"> {{ $seance->id_seance}} </option>
@endforeach
</select>
</div>
<div>
<label for="cours"> Le  cours </label>
<select class="form-control" name="fid_cours">
@foreach ($liste_cours as $cours)
<option value= "{{ $cours->id_cours}}"> {{ $cours->libelle_cours}} </option>
@endforeach
</select>
</div>
<div>
<label for="individu"> Individu </label>
<select class="form-control" name="fid_individu">
@foreach ($liste_individu as $individu)
<option value= "{{ $individu->id_individu}}"> {{ $individu->nom_individu }} </option>
@endforeach
</select>
</div>
<div>
<label for="groupe"> Groupe </label>
<select class="form-control" name="fid_groupe">
@foreach ($liste_groupe as $groupe)
<option value= "{{ $groupe->id_groupe }}"> {{ $groupe->libelle_groupe}} </option>
@endforeach
</select>
</div>
<br><br>
<div>
<input type="datetime" name="date_debut_seance" placeholder="date de debu de seancet">
<input type="datetime" name="date_fin_seance" placeholder="date de fin de seance">
<div>
<br><br>
</table>
<button type="submit" class="btn btn-info">Créer seance groupe</button>
</form>

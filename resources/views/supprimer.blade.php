@extends('layout')

@section('contenu')


<form action="supprimer" method="POST" >
{{ csrf_field ()}}
<br>
<div class="card mx-auto " style="width: 50rem;">
<div class="card-body">


	<h5>Selectionner le groupe :</h5>
	<br>

<select class="form-control" name="groupe1">

  @foreach($listegroupes as $listegroupe)

  <option value= "{{ $listegroupe->id_groupe }}"  > {{ $listegroupe->libelle_groupe }} </option>
  @endforeach
</select>


<br>

<button class="btn btn-danger" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer ?')); else return false;" >Supprimer</button>


</div>
</form>
@endsection
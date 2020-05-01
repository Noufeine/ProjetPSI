@extends('layout')

@section('contenu')

<br> 

<form action="inscrire-individus" method="post" >
{{ csrf_field ()}}

<div class="card mx-auto " style="width: 50rem;">
  <div class="card-body">
<h5>Selectionner le groupe : </h5>
<br> 
<select class="form-control" name= "groupe">

	@foreach($listegroupes as $listegroupe)

	<option value= "{{ $listegroupe->id_groupe }}" > {{ $listegroupe->libelle_groupe }} </option>
	@endforeach
</select>
<br>

<select class="form-control" name="annee" id= "annee">

  @foreach($listeannees as $listeannee)

  <option value= "{{ $listeannee->annee }}" > {{ $listeannee->annee }} </option>
  @endforeach
</select>

<br>
<button class="btn btn-info">Ajouter</button>

</div>

</div>


<div class="container">
    <div class="card mt-4">

      <div>
        <h3 class="">💻 Individus de Nanterre </h3>
      </div>
      
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <tr>
              <th></th>
              <th>Numéro</th>
              <th>Nom</th>
              <th>Prénom</th>
            </tr>
             @foreach($data2 as $row)
       <tr>
       	<td class="text-center" ><input type="checkbox" name="choix[]" value="{{$row->id_individu}}"></td>
        <td>{{ $row->id_individu }}</td>
        <td>{{ $row->nom_individu }}</td>
        <td>{{ $row->prenom_individu }}</td>
       </tr>
       @endforeach
          </table>
        </div>
      </div>
  </div>
</form>
 
























@endsection
<!DOCTYPE html>

@extends('layout')
@section('contenu')

<title>Export Groupes </title>

<div class="container" style="width: 50rem;" >
    <div class="card bg-light mt-3">
        <div class="card-header">
          Export Groupe
        </div>
        <div class="card-body">
            <div class="row">
            <div class="form-group col-md-3">
            <form action="{{ url('export-groupes') }}" method="POST" enctype="multipart/form-data">
                @csrf
                 <input type"text" class="form-control" placeholder="Nom du fichier ..." name="nom_fichier">
</div>
    

<br><br>
<div class="form-group col-md-3">
<select class="form-control" name="groupe">

  @foreach($listegroupes as $listegroupe)

  <option value= "{{ $listegroupe->id_groupe }}" > {{ $listegroupe->libelle_groupe }} </option>
  @endforeach
</select>
</div>
<br>

<div class="form-group col-md-3">
<select class="form-control" name="annee">

  @foreach($listeannees as $listeannee)

  <option value= "{{ $listeannee->annee }}" > {{ $listeannee->annee }} </option>
  @endforeach
</select>
</div>
</div>
    <input type="submit" class="btn btn-info" value="Exporter" name="export_groupe">
            </form>
      

@endsection

@extends('layout')
@section('contenu')
<title>Export Excel </title>
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
          Exportation Excel
        </div>
        <div class="card-body">
            <form action="{{ url('export-individus') }}" method="POST" enctype="multipart/form-data">
                @csrf 
                Nom du fichier : <input type"text" placeholder="Nom du fichier ..." name="nom_fichier">.xls
                <br><br>
                <input type="submit" class="btn btn-success" value="Exporter">
            </form>
        </div>
    </div>
</div>
@endsection
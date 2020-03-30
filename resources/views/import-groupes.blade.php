@extends('layout')

@section('contenu')
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            Importer des Groupes
        </div>
            @if ($errors->any())
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
        <div class="card-body">
            <form action="{{url('import-groupes')}}" method="POST" name="importform" enctype="multipart/form-data">
                @csrf
                <input type="file" name="import_file" class="form-control">
                <br>
                <input type="checkbox" name="choix" onclick="creerGroupe()" id="g"> <i>Créer le groupe s'il n'existe pas<i>
                <br><br>
                <button class="btn btn-success">Import Fichier</button>
            </form>
        </div>
    </div>
</div>

<script>
var i=0;

function creerGroupe(){
  i++;
  i=i%2;
  document.getElementById('g').value=i;
  console.log(i);
}

</script>



@endsection

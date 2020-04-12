@extends('layout')

@section('contenu')

<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            Import Groupes
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
                <button class="btn btn-success">Import Fichier</button>
            </form>
        </div>
    </div>
    <div>
      <div>
        <h3 class="">💻 Groupes de Nanterre </h3>
      </div>
      <div>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <tr>
              <th>Numéro</th>
              <th>Nom</th>
              <th>Prénom</th>
            </tr>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection

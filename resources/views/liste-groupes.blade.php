@extends('layout')

@section('contenu')
<br>
<div class="card mx-auto " style="width: 50%;">
  <div class="card-body">
    @foreach ($groupes as $groupe)
    <table class="table table-sm">
      <tbody>
        <tr>
          <td>{{ $groupe->code_composante }}</td>
          <td>{{ $groupe->libelle_groupe }}</td>
          <td>{{ $groupe->libelle_niveau }}</td>
          <td>{{ $groupe->libelle_formation }}</td>
          <td>{{ $groupe->libelle_modalite }}</td>
          <td>{{ $groupe->annee }}</td>
        </tr>
      </tbody>
    </table>

    @endforeach

  </div>
</div>





@endsection

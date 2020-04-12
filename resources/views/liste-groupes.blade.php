@extends('layout')

@section('contenu')
<br>
<p class = "text-center">

  <span  data-toggle="collapse" href="#collapseExample"  aria-expanded="false" aria-controls="collapseExample">
    2019-2020
  </span>

</p>
<div class="card mx-auto " style="width: 70%;">
  <div class="card-body  table-responsive">
    <?php $couleur="text-info";?>
    <table class="table table-sm " >
      <tbody>
    @for ($i = 0; $i < count($groupes)-1; $i++)


        <tr>
          <td class=<?php echo $couleur;  ?> >{{ $groupes[$i]->code_composante }}</td>
          <td class="text-center" >{{ $groupes[$i]->libelle_niveau }}</td>
          <td class="text-center" >{{ $groupes[$i]->libelle_formation }}</td>
          <td class="text-center" >{{ $groupes[$i]->libelle_modalite }}</td>
          <td class="text-center" >{{ $groupes[$i]->annee }}</td>
        </tr>
        <?php if($groupes[$i]->code_composante!=$groupes[$i+1]->code_composante ) $couleur="text-danger";
        else $couleur="text-info";?>
      
    @endfor

        <?php
        if(count($groupes)>1){
          if($groupes[$i]->code_composante!=$groupes[$i-1]->code_composante) $couleur="text-info";
            else $couleur="text-danger";
        }?>
        <tr>
          <td class=<?php echo $couleur;  ?>>{{ $groupes[$i]->code_composante }}</td>
          <td class="text-center">{{ $groupes[$i]->libelle_niveau }}</td>
          <td class="text-center">{{ $groupes[$i]->libelle_formation }}</td>
          <td class="text-center">{{ $groupes[$i]->libelle_modalite }}</td>
          <td class="text-center">{{ $groupes[$i]->annee }}</td>
        </tr>
        </tbody>
      </table>


  </div>
</div>
<br>







@endsection

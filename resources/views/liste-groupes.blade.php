@extends('layout')

@section('contenu')
<br>

<div class="card mx-auto " style="width: 50rem;">
  <div class="card-body">
<h5>Selectionner le groupe :</h5>
<br>
<div class="row">

<div class="form-group col-md-6">
<select class="form-control" id= "groupe" onchange="Function()">

  @foreach($listegroupes as $listegroupe)

  <option value= "{{ $listegroupe->id_groupe }}" > {{ $listegroupe->libelle_groupe }} </option>
  @endforeach
</select>
</div>
<br>

<div class="form-group col-md-6">
<select class="form-control" id= "annee" onchange="Function()">

  @foreach($listeannees as $listeannee)

  <option value= "{{ $listeannee->annee }}" > {{ $listeannee->annee }} </option>
  @endforeach
</select>
</div>
</div>

<script>
function enleve_tiret(chaine){
  var res="";
  for (var i = 0; i < chaine.length; i++)
  {
    if (chaine[i] != '_') res+=chaine[i];
    else res+=" ";
  }
  return res;
}

function Function() {
  var w = document.getElementById("groupe").selectedIndex;
  var x = document.getElementById("groupe").options;
  var y = document.getElementById("annee").selectedIndex; 
  var z = document.getElementById("annee").options;
  document.getElementById('id_nom_etu').innerHTML="💻 Étudiants "+(enleve_tiret(x[w].text+" "+z[y].text)).toLowerCase()+" de Nanterre";

  var idGroupe = document.getElementById("groupe").value;
  var annee = document.getElementById("annee").value;
  var donnees = @json($listeindividu);
  document.getElementById("id_tableau").innerHTML='';

   var ligne1=document.createElement("tr");
   var colonne1=document.createElement("th");
   var colonne2=document.createElement("th");
   var colonne3=document.createElement("th");
   
   colonne1.innerHTML="Numéro"
   colonne2.innerHTML="Nom"
   colonne3.innerHTML="Prenom"
   
   ligne1.appendChild(colonne1);
   ligne1.appendChild(colonne2);
   ligne1.appendChild(colonne3);
   
   document.getElementById("id_tableau").appendChild(ligne1);

  for (var i = 0; i < donnees.length; i++) {
 //on test si c'est le meme groupe
  if(donnees[i].id_groupe==idGroupe && donnees[i].annee==annee){
       //on creer une ligne
       var ligne2=document.createElement("tr");
        //on cerre les colonnes
      var colonne4=document.createElement("td");
      var colonne5=document.createElement("td");
      var colonne6=document.createElement("td");
       //on remplie les colonne
        colonne4.innerHTML=donnees[i].id_individu;
        colonne5.innerHTML=donnees[i].nom_individu;
        colonne6.innerHTML=donnees[i].prenom_individu;
       //on l'ajoute dans la ligne
        ligne2.appendChild(colonne4);
        ligne2.appendChild(colonne5);
        ligne2.appendChild(colonne6);
       

      //on ajoute la ligne dans le tableau
       document.getElementById("id_tableau").appendChild(ligne2);
    }

}
    
}


</script>


</div><br>

</div>

<br>
<div class="card mx-auto " style="width: 70rem;">

      <div>
        <h4 id="id_nom_etu">💻 Étudiants de Nanterre  </h4>
      </div>

        <div class="table-responsive">
          <table id="id_tableau" class="table table-bordered table-striped">
            <tr>
              
              <th>Numéro</th>
              <th>Nom</th>
              <th>Prénom</th>
            </tr>
             @foreach($listeindividu as $row)
       <tr>
        <td>{{ $row->id_individu }}</td>
        <td>{{ $row->nom_individu }}</td>
        <td>{{ $row->prenom_individu }}</td>
       
       </tr>
       @endforeach
          </table>
        </div>
      </div>
  </div>




@endsection

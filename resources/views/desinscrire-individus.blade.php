@extends('layout')

@section('contenu')

<br>

<form action="desinscrire-individus" method="post" >
{{ csrf_field ()}}


<div class="card mx-auto " style="width: 50rem;">
  <div class="card-body">

<h5>Selectionner le groupe : </h5>
<br> 
<select class="form-control" id= "groupe" onchange="myFunction()">

	@foreach($listegroupes as $listegroupe)

	<option value= "{{ $listegroupe->id_groupe }}" > {{ $listegroupe->libelle_groupe }} </option>
	@endforeach
</select>

<br>

<select class="form-control" id= "annee" onchange="myFunction()">

  @foreach($listeannees as $listeannee)

  <option value= "{{ $listeannee->annee }}" > {{ $listeannee->annee }} </option>
  @endforeach
</select>

<script>
function myFunction() {
  document.getElementById("id_tableau").innerHTML='';
  var idGroupe = document.getElementById("groupe").value;
  var annee = document.getElementById("annee").value;
  var donnees = @json($listeindividu);
  
   var ligne1=document.createElement("tr");
   var colonne1=document.createElement("th");
   var colonne2=document.createElement("th");
   var colonne3=document.createElement("th");
   var colonne8=document.createElement("th");
   colonne8.innerHTML=""
   colonne1.innerHTML="Numéro"
   colonne2.innerHTML="Nom"
   colonne3.innerHTML="Prenom"
   ligne1.appendChild(colonne8);
   ligne1.appendChild(colonne1);
   ligne1.appendChild(colonne2);
   ligne1.appendChild(colonne3);
   var tab=document.getElementById("id_tableau");
   tab.classList.add('table', 'table-bordered' ,'table-striped');
   tab.appendChild(ligne1);

  for (var i = 0; i < donnees.length; i++) {
 //on test si c'est le meme groupe
  if(donnees[i].id_groupe==idGroupe && donnees[i].annee==annee){
       //on creer une ligne
       var ligne2=document.createElement("tr");
        //on cerre les colonnes
      var colonne4=document.createElement("td");
      var colonne5=document.createElement("td");
      var colonne6=document.createElement("td");
      var check=document.createElement("td");
      var check2=document.createElement("input");
       //on remplie les colonne

        colonne4.innerHTML=donnees[i].id_individu
        colonne5.innerHTML=donnees[i].nom_individu
        colonne6.innerHTML=donnees[i].prenom_individu

      
        check.style.textAlign = "center";

       // document.getElementById("check").appendChild(check);


        check2.setAttribute("type","checkbox");
        check2.name="choix[]"
        check2.value=donnees[i].id_individu
        check.appendChild(check2);

        //colonne9.appendchild(check);
       //on l'ajoute dans la ligne
        ligne2.appendChild(check);
        ligne2.appendChild(colonne4);
        ligne2.appendChild(colonne5);
        ligne2.appendChild(colonne6);
        
      //on ajoute la ligne dans le tableau
      
      
       tab.appendChild(ligne2);
    }



}
			return choix;
}



</script>


<br>
<button class="btn btn-info" >Supprimer</button>
</div>
</div>

<br>

<div class="card mx-auto " style="width: 70rem;">
    

      <div>
        <h3 class="">💻 Individus de Nanterre </h3>
      </div>

        <div  class="table-responsive">
          <table id="id_tableau" class="table table-bordered ">
            <tr>
              <th></th>
              <th>Numéro</th>
              <th>Nom</th>
              <th>Prénom</th>
            </tr>
            
       <tr>
       	
       </tr>
    
          </table>
        </div>
      </div>
  </div>
</form>
@endsection

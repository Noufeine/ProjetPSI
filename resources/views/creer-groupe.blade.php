@extends('layout')

@section('contenu')

<br>
<div class="card mx-auto " style="width: 50rem;">
  <div class="card-body">
    <form action="liste-groupes" method="POST" >
      {{ csrf_field ()}}
      <div>
        <label for="ufr">Unités de formation et de recherche (UFR)</label>
        <select class="form-control" name="ufr" id="ufr" onchange="creerFormation()">
          <option> </option>
          <option value="DSP"> Droit et Science Politique (DSP) </option>
          <option value="LCE"> Langues et Cultures Étrangères (LCE) </option>
          <option value="PHILLIA"> Philosophie, Information-Communication, Langage, Littérature, Arts du Spectacle (PHILLIA) </option>
          <option value="SEGMI"> Sciences Économiques, Gestion, Mathématiques, Informatique (SEGMI) </option>
          <option value="SITEC"> Systèmes Industriels et Techniques de Communication (SITEC) </option>
          <option value="SPSE"> Sciences Psychologiques et Sciences de l'Éducation (SPSE)</option>
          <option value="SSA"> Sciences Sociales et Administration (SSA) </option>
          <option value="STAPS"> Sciences et Techniques des Activités Physiques et Sportives (STAPS) </option>
          <option value="IUT"> IUT Ville d'Avray / Saint-Cloud / Nanterre </option>
          <option value="IPAG"> Institut de Préparation à l'Administration Générale (IPAG)</option>
        </select>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="modalite">Niveau</label>
          <select class="form-control" name="niveau" id="niveau" onchange="creerFormation()">
            <option></option>
            <option value="L1">Licence 1</option>
            <option value="L2">Licence 2</option>
            <option value="L3">Licence 3</option>
            <option value="M1">Master 1</option>
            <option value="M2">Master 2</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="formation">Formation</label>
          <select class="form-control" name="formation" id="formation" >
          </select>
        </div>

      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="modalite">Modalité</label>
          <select class="form-control" name="modalite">
            <option value="FI">FI (Formation initiale)</option>
            <option value="foreach">FC (Formation continue)</option>
            <option value="Miste"> Mixte</option>
            <option value="APP">APP (Apprentissage)</option>
            <option value="CP">CP (Contrat de Professionnalisation)</option>
            <option value="EAD">EAD (Enseignement à distance)</option>
          </select>
        </div>

        <div class="form-group col-md-6">
          <label for="annee">Année</label>
          <select class="form-control" name="annee">
            <option value="2019-2020">2019-2020</option>
            <option value="2018-2019">2018-2019</option>
            <option value="2017-2018">2017-2018</option>
            <option value="2016-2017">2016-2017</option>
            <option value="2015-2016">2015-2016</option>
          </select>
        </div>
      <button type="submit" class="btn btn-info">Créer le groupe</button>
      </div>
    </form>
  </div>
</div>
<div id="div">


</div>


<script>




var formations=@json($formations);
console.log(formations);


function creerFormation() {

  var ufr=document.getElementById('ufr').value;
  var niveau=document.getElementById('niveau').value;


  var formationSelect=document.getElementById('formation');
  formationSelect.innerHTML="";

  formations.forEach(function(formation){
    if(ufr==formation["code_composante"] && niveau==formation["code_niveau"])
    {
      var formationOption = document.createElement("option");
      formationOption.innerHTML=formation["libelle_formation"];
      formationOption.value=formation["libelle_formation"];
      formationSelect.appendChild(formationOption);
    }
  });


}


</script>







@endsection

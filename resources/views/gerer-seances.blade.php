
@extends('layout')

@section('contenu')
<title>Gerer les séances</title>
<?php
//pour fixer le timezone
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

$date_du_jour=date_create(request('date_du_jour'));
$j= date_format($date_du_jour,'w');

$semaine_suivante=utf8_encode(strftime('%Y-%m-%d', mktime(0, 0, 0, date_format($date_du_jour,'m'), date_format($date_du_jour,'d')+7, date_format($date_du_jour,'y'))));
$semaine_precedente=utf8_encode(strftime('%Y-%m-%d', mktime(0, 0, 0, date_format($date_du_jour,'m'), date_format($date_du_jour,'d')-7, date_format($date_du_jour,'y'))));

 ?>
 <style>
 .msg {
   width: 300px;
   height: 30px;
   position: fixed;
   right: 0;
   animation-name: notification;
   animation-duration: 9s;
   margin-top: -140px;
   text-align: center;
   color: white;
 }

 @keyframes notification {
   0%   {right:0px; top:-100px;}
   50%  {right:0px; top:170px;}
   100% {right:0px; top:-100px;}
 }
 </style>

<!--Pour afficher des messages de notification-->
<?php
if(request('msg')=="supprime_seance"){
  print '<div class="msg bg-info card">

     La séance a été supprimée avec succès
     <br>
  </div>';
}
else if(request('msg')=="modifie_seance"){
  print '<div class="msg bg-info card">
     La séance a été modifiée avec succès
  </div>';
}
else if(request('msg')=='creer_seance'){
  print '<div class="msg bg-info card">
     La séance a été créée avec succès
  </div>';
}
else if(request('msg')=='error_creer_seance'){
  print '<div class="msg bg-danger card">
     Cette plage Horraire a été déjà reservée
  </div>';
}
?>

<div class="row" style="">
  <div class="col-sm-6" style="background-color:#225d8c; text-align:left; color: white">
     &nbsp;<i>Changer de Salle :</i>
     <select onchange="actualiser()" id="id_salle">
      <?php 
        print '<optgroup label="Bâtiment '.$salles[0]->numero_salle[0].'">';
        $bat = $salles[0]->numero_salle[0];
      ?>
       <?php if(!empty(request('salle'))){
         print '<option>'.request("salle").'</option>';
       } ?>
       <?php
       
       for ($i=0; $i <count($salles) ; $i++) {
        if($salles[$i]->numero_salle[0] != $bat){
            $bat = $salles[$i]->numero_salle[0];
            print  '</optgroup>';
            print '<optgroup label="Bâtiment '.$salles[$i]->numero_salle[0].'">';
          }
         print '<option >'.$salles[$i]->numero_salle.'</option>';
       }
       print  '</optgroup>';
       ?>
     </select>
     &nbsp;&nbsp;&nbsp;
     <button class="btn btn-danger" data-toggle="modal" data-target="#creerSeanceModal">Créer Une Séance</button>
   </div>
   <div class="col-sm-6" style="background-color:#225d8c; text-align:right; color: white">
     <a  href="gerer-seances?date_du_jour=<?php print $semaine_precedente;?>"><img src="http://free-icon-download.com/modules/PDdownloads/images/screenshots/free-icon-download_gradient-left-arrow.png" width="6%"></a>
     Semaine
     <a href="gerer-seances?date_du_jour=<?php print $semaine_suivante;?>"><img src="http://icon-library.com/images/next-icon/next-icon-2.jpg" width="6%"></a>
     &nbsp;&nbsp;&nbsp;<i>Changer de date :</i>
     <input type="date" onchange='var v=value;window.location.href="?date_du_jour="+value' value="<?php print utf8_encode(strftime('%Y-%m-%d', mktime(0, 0, 0, date_format($date_du_jour,'m'), date_format($date_du_jour,'d'), date_format($date_du_jour,'y'))));  ?>">&nbsp;
   </div>
 </div>
<div style="text-align :center; color : #b06b00"><img src="https://cdn.onlinewebfonts.com/svg/img_85286.png" width="2%"> Cliquez sur une plage horaire remplie pour plus d'information sur la séance</div>


<!-- Modal pour la creation d'une seance -->
<form action="{{ url('gerer-seances') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="creerSeanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Creer une seance</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body table-responsive ">
          <table>
            <tr>
              <td> Cours  </td>
              <td >
                <select name="id_cours">
                  <option ></option>
                  <?php
                  for ($i=0; $i < count($cours) ; $i++) {
                    print '<option value ="'.$cours[$i]->id_cours.'">'.$cours[$i]->libelle_cours.'</option>';
                  }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td> Enseignant  </td>
              <td>
                <select name="id_enseignant">
                  <option ></option>
                  <?php
                  for ($i=0; $i < count($enseignants) ; $i++) {
                    print '<option value ="'.$enseignants[$i]->id_individu.'">'.$enseignants[$i]->nom_individu.' '.$enseignants[$i]->prenom_individu.'</option>';
                  }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td> Salle  </td>
              <td>
                <select name="id_salle">
                  <option ></option>
                  <?php
                  for ($i=0; $i < count($salles) ; $i++) {
                    print '<option value ="'.$salles[$i]->id_salle.'">'.$salles[$i]->numero_salle.'</option>';
                  }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td> Groupe  </td>
              <td>
                <select name="id_groupe">
                  <option ></option>
                  <?php
                  for ($i=0; $i < count($groupes) ; $i++) {
                    print '<option value ="'.$groupes[$i]->id_groupe.'">'.$groupes[$i]->libelle_groupe.'</option>';
                  }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
              <td> Durée  </td>
              <td>
                <input type="date" id="id_dateSeance" name="date_seance">
                <select onchange="dureeSeance()" id="id_debut" name="heure_debut_seance">
                  <?php
                  for ($i=8; $i < 22 ; $i++) {
                    print '<option value="'.$i.':00:00">'.$i.':00</option>';
                    print '<option value="'.$i.':30:00">'.$i.':30</option>';
                  }
                  ?>
                </select>
                 -
                <select id="id_fin" name="heure_fin_seance" onchange="afficher()">
                  <?php
                  for ($i=8; $i < 22 ; $i++) {
                    print '<option value="'.$i.':00:00">'.$i.':00</option>';
                    print '<option value="'.$i.':30:00">'.$i.':30</option>';
                  }
                  ?>
                </select>
               </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <input class="btn btn-success" type="submit" value="Créer" name="creer">
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Modal pour plus d'information sur une seance -->
<form action="{{ url('gerer-seances') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="informationsModal" tabindex="-1" role="dialog" aria-labelledby="informationsModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" >
          <img src="https://cdn.pixabay.com/photo/2017/03/19/03/50/material-icon-2155446_960_720.png" width="10%">
          <h5 class="modal-title" id="id_matiere"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body table-responsive" >
          <p id="id_type"></p>
          <p id="id_nom"></p>
          <p id="id_groupe"></p> Le
          <span id="id_dte"></span> de 
          <span id="id_dbt"></span> à
          <span id="id_fn"></span>
          <input type="hidden" id="id_fid_seance" name="fid_seance">
          <input type="hidden" id="id_fid_groupe" name="fid_groupe">
          <input type="hidden" id="id_fid_individu" name="fid_individu">
          <input type="hidden" id="id_fid_cours" name="fid_cours">
          <input type="hidden" id="id_date_debut_seance" name="date_debut_seance">
          <input type="hidden" id="id_date_fin_seance" name="date_fin_seance">
          <input type="hidden"  name="date_du_jour" value=<?php print request('date_du_jour'); ?>>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary " data-dismiss="modal" onclick="modifier()" data-toggle="modal" data-target="#modifierSeanceModal"> Modifier </button>
          <input type="submit" class="btn btn-danger" value="Supprimer" name="supprimer" onclick= "if(confirm('Êtes-vous sûr de vouloir supprimer ?')); else return false;">
        </div>
      </div>
    </div>
  </div>
</form>
<!---->
<div class='table-responsive'>
  <table class="table">
      <tr>
        <th >Heures</th>
        <?php
        $j= date_format($date_du_jour,'w');
        if($j==0){
          for ($i=6; $i >=0 ; $i--) {
            $d=utf8_encode(strftime('%a %d %b %Y', mktime(0, 0, 0, date_format($date_du_jour,'m'), date_format($date_du_jour,'d')-$i, date_format($date_du_jour,'y'))));
            print '<th >'.$d.'</th>';
          }
        }
        else {
          for ($i=$j-1; $i >=1 ; $i--) {
            $d=utf8_encode(strftime('%a %d %b %Y', mktime(0, 0, 0, date_format($date_du_jour,'m'), date_format($date_du_jour,'d')-$i, date_format($date_du_jour,'y'))));
            print '<th >'.$d.'</th>';
          }
          for ($k=0; $k <=7-$j; $k++) {
            $d=utf8_encode(strftime('%a %d %b %Y', mktime(0, 0, 0, date_format($date_du_jour,'m'), date_format($date_du_jour,'d')+$k, date_format($date_du_jour,'y'))));
            print '<th >'.$d.'</th>';
          }

        }
         ?>

      <?php

      for ($i=8; $i < 22; $i++) {
        print '<tr>';
          print '<td>'.$i.'h00 - '.$i.'h30</td>';
          //la par exemple je suis ou
          print '<td id="id_colonne_1_'.$i.'">
            <input class="col-xs-2" type="text" id="1_'.$i.'" data-toggle="modal" data-target="#informationsModal" onclick="infos(\'1_'.$i.'\')">
            <input type="hidden" id="id_type_1_'.$i.'">
            <input type="hidden" id="id_nom_1_'.$i.'">
            <input type="hidden" id="id_groupe_1_'.$i.'">
            <input type="hidden" id="id_fid_seance_1_'.$i.'">
            <input type="hidden" id="id_fid_groupe_1_'.$i.'">
            <input type="hidden" id="id_fid_individu_1_'.$i.'">
            <input type="hidden" id="id_fid_cours_1_'.$i.'">
            <input type="hidden" id="id_date_debut_seance_1_'.$i.'">
            <input type="hidden" id="id_date_fin_seance_1_'.$i.'">
          </td>';
          print '<td>
          <input type="text" id="2_'.$i.'" data-toggle="modal" data-target="#informationsModal" onclick="infos(\'2_'.$i.'\')">
          <input type="hidden" id="id_type_2_'.$i.'">
          <input type="hidden" id="id_nom_2_'.$i.'">
          <input type="hidden" id="id_groupe_2_'.$i.'">
          <input type="hidden" id="id_fid_seance_2_'.$i.'">
          <input type="hidden" id="id_fid_groupe_2_'.$i.'">
          <input type="hidden" id="id_fid_individu_2_'.$i.'">
          <input type="hidden" id="id_fid_cours_2_'.$i.'">
          <input type="hidden" id="id_date_debut_seance_2_'.$i.'">
          <input type="hidden" id="id_date_fin_seance_2_'.$i.'">
          </td>';
          print '<td>
          <input type="text" id="3_'.$i.'" data-toggle="modal" data-target="#informationsModal" onclick="infos(\'3_'.$i.'\')">
          <input type="hidden" id="id_type_3_'.$i.'">
          <input type="hidden" id="id_nom_3_'.$i.'">
          <input type="hidden" id="id_groupe_3_'.$i.'">
          <input type="hidden" id="id_fid_seance_3_'.$i.'">
          <input type="hidden" id="id_fid_groupe_3_'.$i.'">
          <input type="hidden" id="id_fid_individu_3_'.$i.'">
          <input type="hidden" id="id_fid_cours_3_'.$i.'">
          <input type="hidden" id="id_date_debut_seance_3_'.$i.'">
          <input type="hidden" id="id_date_fin_seance_3_'.$i.'">
          </td>';
          print '<td>
          <input type="text" id="4_'.$i.'" data-toggle="modal" data-target="#informationsModal" onclick="infos(\'4_'.$i.'\')">
          <input type="hidden" id="id_type_4_'.$i.'">
          <input type="hidden" id="id_nom_4_'.$i.'">
          <input type="hidden" id="id_groupe_4_'.$i.'">
          <input type="hidden" id="id_fid_seance_4_'.$i.'">
          <input type="hidden" id="id_fid_groupe_4_'.$i.'">
          <input type="hidden" id="id_fid_individu_4_'.$i.'">
          <input type="hidden" id="id_fid_cours_4_'.$i.'">
          <input type="hidden" id="id_date_debut_seance_4_'.$i.'">
          <input type="hidden" id="id_date_fin_seance_4_'.$i.'">
          </td>';
          print '<td>
          <input type="text" id="5_'.$i.'" data-toggle="modal" data-target="#informationsModal" onclick="infos(\'5_'.$i.'\')">
          <input type="hidden" id="id_type_5_'.$i.'">
          <input type="hidden" id="id_nom_5_'.$i.'">
          <input type="hidden" id="id_groupe_5_'.$i.'">
          <input type="hidden" id="id_fid_seance_5_'.$i.'">
          <input type="hidden" id="id_fid_groupe_5_'.$i.'">
          <input type="hidden" id="id_fid_individu_5_'.$i.'">
          <input type="hidden" id="id_fid_cours_5_'.$i.'">
          <input type="hidden" id="id_date_debut_seance_5_'.$i.'">
          <input type="hidden" id="id_date_fin_seance_5_'.$i.'">
          </td>';
          print '<td>
          <input type="text" id="6_'.$i.'" data-toggle="modal" data-target="#informationsModal" onclick="infos(\'6_'.$i.'\')">
          <input type="hidden" id="id_type_6_'.$i.'">
          <input type="hidden" id="id_nom_6_'.$i.'">
          <input type="hidden" id="id_groupe_6_'.$i.'">
          <input type="hidden" id="id_fid_seance_6_'.$i.'">
          <input type="hidden" id="id_fid_groupe_6_'.$i.'">
          <input type="hidden" id="id_fid_individu_6_'.$i.'">
          <input type="hidden" id="id_fid_cours_6_'.$i.'">
          <input type="hidden" id="id_date_debut_seance_6_'.$i.'">
          <input type="hidden" id="id_date_fin_seance_6_'.$i.'">
          </td>';

          print '<td>
          <input type="text" id="0_'.$i.'" data-toggle="modal" data-target="#informationsModal" onclick="infos(\'0_'.$i.'\')">
          <input type="hidden" id="id_type_0_'.$i.'">
          <input type="hidden" id="id_nom_0_'.$i.'">
          <input type="hidden" id="id_groupe_0_'.$i.'">
          <input type="hidden" id="id_fid_seance_0_'.$i.'">
          <input type="hidden" id="id_fid_groupe_0_'.$i.'">
          <input type="hidden" id="id_fid_individu_0_'.$i.'">
          <input type="hidden" id="id_fid_cours_0_'.$i.'">
          <input type="hidden" id="id_date_debut_seance_0_'.$i.'">
          <input type="hidden" id="id_date_fin_seance_0_'.$i.'">
          </td>';
        print '</tr>';
      }
       ?>
  </table>
</div>

<!--Pour la modification -->
<form action="{{ url('gerer-seances') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="modifierSeanceModal" tabindex="-1" role="dialog" aria-labelledby="modifierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Modifier la séance</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body table-responsive ">
          <input type="hidden" id="id_fid_cours_modifier" name="fid_cours" >
          <input type="hidden" id="id_fid_individu_modifier" name="fid_individu">
          <input type="hidden" id="id_fid_groupe_modifier" name="fid_groupe">
          <table>
            <tr>
              <td>Cours : </td>
              <td id="id_cours_modifier" >

              </td>
            </tr>
            <tr>
              <td>Enseignant : </td>
              <td id="id_enseignant_modifier">

              </td>
            </tr>
            <tr>
              <td>Groupe : </td>
              <td id="id_groupe_modifier">
              </td>
            </tr>
            <tr>
              <td>Salle : </td>
              <td>
                <select name="numero_salle">
                  <option id="id_salle_modifier"></option>
                  <?php
                  for ($i=0; $i < count($salles); $i++) {
                    print '<option>'.$salles[$i]->numero_salle.'</option>';
                  }
                   ?>
                 </select>
            </td>
            <tr>
              <td> Durée</td>
              <td>
                <input type="date" id="id_date_modifier" name="date_seance">
                <select onchange="dureeSeance()" name="heure_debut_seance">
                  <option id="id_heure_debut_modifier"></option>
                  <?php
                  for ($i=8; $i < 22 ; $i++) {
                    print '<option value="'.$i.':00:00">'.$i.':00</option>';
                    print '<option value="'.$i.':30:00">'.$i.':30</option>';
                  }
                  ?>
                </select>
                 -
                <select name="heure_fin_seance" onchange="afficher()">
                  <option id="id_heure_fin_modifier"></option>
                  <?php
                  for ($i=8; $i < 22 ; $i++) {
                    print '<option value="'.$i.':00:00">'.$i.':00</option>';
                    print '<option value="'.$i.':30:00">'.$i.':30</option>';
                  }
                  ?>
                </select>
              </td>
            <tr>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
          <input class="btn btn-success" type="submit" value="Modifier" name="modifier">
        </div>
      </div>
    </div>
  </div>
</form>

<script>

//pour definir la date et l'heure de l'utilisateur
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});
//par default, la date de la seance est la date du jour
document.getElementById('id_dateSeance').value = new Date().toDateInputValue();
function dureeSeance(){
  var selectHeureFin= document.getElementById("id_fin");
  var heure=document.getElementById('id_debut').value;
  selectHeureFin.innerHTML='';
  var h;
  if(heure[1]==':')heure=heure[0];
  else heure=heure[0]+heure[1];



  for (i=parseInt(heure)+1; i < 22; i++) {
    var option1=document.createElement("option");
    var option2=document.createElement("option");
    option1.value=i+":00:00";
    option1.innerHTML=i+":00";
    option2.value=i+":30:00";
    option2.innerHTML=i+":30";
    selectHeureFin.appendChild(option1);
    selectHeureFin.appendChild(option2);
  }
}

//je transforme mets mets données dans un tableau JS 
var liste = @json($liste_seances_groupes);
//fonction qui actualise les données en fonction de la salle selectionnée
function actualiser(){
  
  for (var i = 8; i < 22; i++) {
    for(var j=0;j<=6; j++){
      //je vide le tableau des données
      document.getElementById(j+"_"+i).value='';
      //j'enlève le disabled les mets à disabled
      document.getElementById(j+"_"+i).removeAttribute("disabled");

    }
  }
  for (var i = 0; i < liste.length; i++) {
    //si c'est la salle choisis, j'affiche les cours
    if (liste[i].numero_salle==document.getElementById('id_salle').value) {
      //je recupere le noumero du jour correspondant
      var dateDebut=new Date(liste[i].date_debut_seance);
      var dateFin=new Date(liste[i].date_fin_seance);
      var jour=dateDebut.getDay();

      //je recupere les heures
      var heureDebut=dateDebut.getHours();
      var heureFin=dateFin.getHours();

      for (var h = heureDebut; h <= heureFin; h++) {
        var id=jour+"_"+h;
        var id_type="id_type_"+jour+"_"+h;
        var id_nom="id_nom_"+jour+"_"+h;
        var id_groupe="id_groupe_"+jour+"_"+h;
        document.getElementById(id).value=liste[i].libelle_cours;
        document.getElementById(id_type).value=liste[i].libelle_type_seance;
        document.getElementById(id_nom).value=liste[i].nom_individu+" "+liste[i].prenom_individu;
        document.getElementById(id_groupe).value=liste[i].libelle_groupe;
        var id_fid_seance="id_fid_seance_"+jour+"_"+h;
        var id_fid_groupe="id_fid_groupe_"+jour+"_"+h;
        var id_fid_individu="id_fid_individu_"+jour+"_"+h;
        var id_fid_cours="id_fid_cours_"+jour+"_"+h;
        var id_date_debut_seance="id_date_debut_seance_"+jour+"_"+h;
        var id_date_fin_seance="id_date_fin_seance_"+jour+"_"+h;
        document.getElementById(id_fid_seance).value=liste[i].fid_seance;
        document.getElementById(id_fid_groupe).value=liste[i].fid_groupe;
        document.getElementById(id_fid_individu).value=liste[i].fid_individu;
        document.getElementById(id_fid_cours).value=liste[i].fid_cours;
        document.getElementById(id_date_debut_seance).value=liste[i].date_debut_seance;
        document.getElementById(id_date_fin_seance).value=liste[i].date_fin_seance;
      }
    }
  }
  //si la colonne n'a pas été  remplie je la mets à desabled
  for (var i = 8; i < 22; i++) {
    //si la collonne n'a pas été remplie je la mets à disabled
    for(var j=0;j<=6; j++){
      if(document.getElementById(j+"_"+i).value==""){
        document.getElementById(j+"_"+i).setAttribute("disabled","disabled");
      }
    }
  }
}

actualiser();

//pour afficher les données d'une seance dans un Modal
function infos(id){
  var id_type="id_type_"+id;
  var id_nom="id_nom_"+id;
  var id_groupe="id_groupe_"+id;
  var id_dbt="id_date_debut_seance_"+id;
  var id_fn="id_date_fin_seance_"+id;
  document.getElementById("id_matiere").innerHTML=document.getElementById(id).value;
  document.getElementById("id_type").innerHTML=document.getElementById(id_type).value;
  document.getElementById("id_nom").innerHTML=document.getElementById(id_nom).value;
  document.getElementById("id_groupe").innerHTML=document.getElementById(id_groupe).value;
  var dateDebut =  document.getElementById(id_dbt).value;
  dateDebut=new Date(dateDebut);
  var jour=(dateDebut.getDate()<10?'0':'') + dateDebut.getDate();
  var mois=dateDebut.getMonth()+1;
  mois=(mois<10?'0':'')+mois;
  var annee=dateDebut.getFullYear();
  var dateFin = document.getElementById(id_fn).value;
  dateFin=new Date(dateFin);
  var minutesDebut=(dateDebut.getMinutes()<10?'0':'') + dateDebut.getMinutes()
  var heureDebut=(dateDebut.getHours()<10?'0':'') + dateDebut.getHours();
  var heureFin=(dateFin.getHours()<10?'0':'') + dateFin.getHours();
  var minutesFin=(dateFin.getMinutes()<10?'0':'') + dateFin.getMinutes();
  document.getElementById("id_dte").innerHTML=annee+"-"+mois+"-"+jour;
  document.getElementById("id_dbt").innerHTML=heureDebut+":"+minutesDebut;
  document.getElementById("id_fn").innerHTML=heureFin+":"+minutesFin;
  var id_fid_seance="id_fid_seance_"+id;
  var id_fid_groupe="id_fid_groupe_"+id;
  var id_fid_individu="id_fid_individu_"+id;
  var id_fid_cours="id_fid_cours_"+id;
  var id_date_debut_seance="id_date_debut_seance_"+id;
  var id_date_fin_seance="id_date_fin_seance_"+id;
  document.getElementById("id_fid_seance").value=document.getElementById(id_fid_seance).value;
  document.getElementById("id_fid_groupe").value=document.getElementById(id_fid_groupe).value;
  document.getElementById("id_fid_individu").value=document.getElementById(id_fid_individu).value;
  document.getElementById("id_fid_cours").value=document.getElementById(id_fid_cours).value;
  document.getElementById("id_date_debut_seance").value=document.getElementById(id_date_debut_seance).value;
  document.getElementById("id_date_fin_seance").value=document.getElementById(id_date_fin_seance).value;
}

//pour modifer les données d'une seance
function modifier(){
  document.getElementById("id_cours_modifier").value= document.getElementById("id_matiere").innerHTML;
  document.getElementById("id_cours_modifier").innerHTML= document.getElementById("id_matiere").innerHTML;
  document.getElementById("id_enseignant_modifier").value= document.getElementById("id_nom").innerHTML;
  document.getElementById("id_enseignant_modifier").innerHTML= document.getElementById("id_nom").innerHTML;
  document.getElementById("id_salle_modifier").value= document.getElementById("id_salle").value;
  document.getElementById("id_salle_modifier").innerHTML= document.getElementById("id_salle").value;
  document.getElementById("id_groupe_modifier").value= document.getElementById("id_groupe").innerHTML;
  document.getElementById("id_groupe_modifier").innerHTML= document.getElementById("id_groupe").innerHTML;
  document.getElementById("id_heure_debut_modifier").value=document.getElementById("id_dbt").innerHTML;
  document.getElementById("id_heure_debut_modifier").innerHTML=document.getElementById("id_dbt").innerHTML;
  document.getElementById("id_heure_fin_modifier").value=document.getElementById("id_fn").innerHTML;
  document.getElementById("id_heure_fin_modifier").innerHTML=document.getElementById("id_fn").innerHTML;
  document.getElementById("id_date_modifier").value=document.getElementById("id_dte").innerHTML;
  document.getElementById("id_date_modifier").innerHTML=document.getElementById("id_dte").innerHTML;
  document.getElementById("id_fid_cours_modifier").value=document.getElementById("id_fid_cours").value;
  document.getElementById("id_fid_individu_modifier").value=document.getElementById("id_fid_individu").value;
  document.getElementById("id_fid_groupe_modifier").value=document.getElementById("id_fid_groupe").value;
}
console.log(liste);
</script>

@endsection

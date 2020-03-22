<html>

<head>


      <title> Ajout </title>


</head>
<body>


<form action="/seance" method="post">
       {{ csrf_field() }}




       <input type="number" name="numero_salle" placeholder="numero de salle"><br>
       <input type="number" name="capacite_salle" placeholder="capacite de la sallle"><br>
       <input type="number" name="nb_postes" placeholder="nombre de poste"><br>
       <input type="number" name="projecteur" placeholder="projecteur"><br>
       <input type="text" name="libelle_type_seance" placeholder="libelle type seance"><br>
       <input type="text" name="libelle_cours" placeholder="cours"><br>
       <input type="text" name="libelle_niveau" placeholder="libelle_niveau"><br>
       <input type="text" name="libelle_formation" placeholder="libelle formation"><br>
       <input type="text" name="libelle_modalite" placeholder="libelle modalite"><br>
       <input type="text" name="libelle_groupe" placeholder="libelle groupe"><br>
       <input type="text" name="annee" placeholder="annee"><br>
       <input type="number" name="annuaire" placeholder="annuaire"><br>
       <input type="text" name="id_individu" placeholder="numero_individu"><br>
       <input type="text" name="nom_individu" placeholder="nom_individu"><br>
       <input type="text" name="prenom_individu" placeholder="prenom individu"><br>
       <input type="text" name="mail_individu" placeholder="mail individu"><br>
       <input type="text" name="tel_individu" placeholder="tel individu"><br>
       <input type="datetime" name="date_debut_seance" placeholder="date debut de seance"><br>
       <input type="datetime" name="date_fin_seance" placeholder="date de fin de seance"><br>
       <input type="text" name="id_type_individu" placeholder="id type individu"><br>
       <input type="text" name="libelle_type_individu" placeholder="libelle type individu"><br>
       <input type="text" name="libelle_composante" placeholder="libelle composante"><br>

       <input type="submit" value="envoyer"><br>



   </form>
</body>

</html>

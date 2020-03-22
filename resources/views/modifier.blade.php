<html>

<head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title> modification </title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.css" />

</head>


<body>

  <form action="/modification" method="post">
{{ csrf_field() }}

quelle numero de salle voulez vous modifier <br>



<input type="number" name="numero_salle" placeholder="numero de salle">
<br>

<div class="control">
  <input type="number" name="capacite_salle" placeholder="capacite de la sallle">
  <input type="number" name="nb_postes" placeholder="nombre de poste">
  <input type="number" name="projecteur" placeholder="projecteur">
  <input type="text" name="libelle_type_seance" placeholder="libelle type seance">
</div>

<div class="field">
        <div class="control">
            <button class="button is-link" type="submit">Modifier</button>
        </div>
    </div>


</from>

</body>

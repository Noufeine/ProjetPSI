<html>

<head>


      <title> Ajout </title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.css" />

</head>
<body>


<form action="/seance" method="post">
       {{ csrf_field() }}

       <select name="numero_salle" id="id_salle" class="form-control">
                                    @foreach($fid_salle as $salle)
                                        <option value="{{ $salle->numero_salle }}"> {{ $salle->numero_salle }}</option>
                                    @endforeach
          </select>




    

       <input type="submit" value="envoyer"><br>



   </form>
</body>

</html>

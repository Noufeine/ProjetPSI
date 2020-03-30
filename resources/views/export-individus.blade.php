<!DOCTYPE html>
<html>

@extends('layout')
@section('contenu')
<head>
    <title>Export Excel </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body>


<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
          Exportation Excel
        </div>
        <h1>  </h1>
        <div class="card-body">
            <form action="{{ url('export-individus') }}" method="POST" enctype="multipart/form-data">
                @csrf 
<br>
                    <input type="submit" class="btn btn-success" value="Exporter">


            </form>
        </div>
    </div>
</div>

</body>
@endsection
</html>

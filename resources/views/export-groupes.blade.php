<!DOCTYPE html>

@extends('layout')
@section('contenu')

<title>Export Groupes </title>

<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
          Exportation Excel
        </div>
        <div class="card-body">
            <form action="{{ url('export-groupes') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="submit" class="btn btn-success" value="export_groupe">
            </form>
        </div>
    </div>
</div>

@endsection

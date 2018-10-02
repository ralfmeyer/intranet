<!-- resources/views/sql/create.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
      <nav class="navbar navbar-inverse">
          <ul class="nav navbar-nav">
              <li><a href="{{ URL::to('sql') }}">Alle SQL-Anweisungen anzeigen</a></li>
          </ul>
      </nav>
<h1>Neue Anweisung erstellen</h1>

<!-- if there are creation errors, they will show here -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ url('sql') }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}


    <div class="form-group">
        <label for="formGroupExampleInput">String:</label>
        <input type="text" name="bezeichnung" class="form-control" value="{{ old('bezeichnung') }}">

    </div>

    <div class="form-group">
        <label for="anweisung">SQL-Anweisung</label>
        <textarea class="form-control" id="anweisung" rows="6" name="anweisung"></textarea>
    </div>

    <div class="form-group">
</div>

<!-- Add Button -->
 <div class="form-group">
     <div class="col-sm-offset-3 col-sm-6">
         <button type="submit" class="btn btn-default">
             <i class="fa fa-btn fa-plus"></i>Add
         </button>
     </div>
 </div>

</form>
</div>
@endsection
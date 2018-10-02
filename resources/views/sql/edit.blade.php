<!-- resources/views/sql/edit.blade.php -->
@extends('layouts.app')
@section('content')
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> 
<script>
    $(document).ready( function () {
        $.noConflict();
        $('#check').click(function(){
            var json = $('#options').text();
            console.log (json);
            alert (JSON.parse(json));
        });
       });
</script>
<div class="container">
      <nav class="navbar navbar-inverse">
          <ul class="nav navbar-nav">
              <li><a href="{{ URL::Route('sql.index') }}">Alle SQL-Anweisungen anzeigen</a></li>
          </ul>
      </nav>
<h1>SQL-Anweisung "{{ $sql->bezeichnung }}" ändern</h1>

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

<form action="{{ url('sql') }}/{{$sql->id }}" method="POST" class="form-horizontal">
    {{ csrf_field() }}
    {{ method_field('PATCH')}}

    <div class="form-group">
        <label for="formGroupExampleInput">Bezeichnung:</label>
        <input type="text" name="bezeichnung" class="form-control" value="{{ $sql->bezeichnung }}">
    </div>
    <div class="form-group">
            <label for="formGroupExampleInput">Formularvorlage:</label>
            <input type="text" name="ausgabe" class="form-control" value="{{ $sql->ausgabe }}">
    </div>    

    <div class="form-group code">
            <label for="formGroupExampleInput">SQL-Anweisung:</label>
            <textarea class="form-control" id="anweisung" rows="6" name="anweisung">{{ $sql->anweisung }}</textarea>
    </div>

    <div class="form-group code">
        <label for="formGroupExampleInput">Optionen:</label>
        <textarea class="form-control" id="options" rows="6" name="options">{{ $sql->options }}</textarea>
    </div>

    <div class="form-group">
        <label for="formGroupExampleInput">Rollen:</label>
        <select name="roles[]" size="5" multiple>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" @if ($sql->hasRole($role->name)==true) selected @endif   >{{ $role->description }}</option>
                @endforeach
            </select>
    
    </div>    

    <!-- Update Button -->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <a href="#" id ="check">Check</a>
            <button type="check" class="btn btn-default" id="checkx">
                <i class="fa fa-btn fa-plus">Check</i>
            </button>
        </div>
    </div>
    <!-- Update Button -->
    <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-btn fa-plus">&Auml;ndern</i>
            </button>
        </div>
    </div>

    </form>
</div>
@endsection
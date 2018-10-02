<!-- resources/views/sql/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('sql/create') }}">SQL-Anweisung erzeugen</a>
    </ul>
</nav>
<h1>Alle meine Anweisungen</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Bezeichnung</td>
            <td>Anweisung</td>
            <td>Optionen</td>

        </tr>
    </thead>
    <tbody>
    @foreach($sql as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->bezeichnung }}</td>
            <td>{{ $value->anweisung }}</td>
            <td>{{ $value->options }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- show the myinput (uses the show method found at GET /myinputs/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('sql/' . $value->id) }}">Anzeigen</a>

                <!-- edit this myinput (uses the edit method found at GET /myinputs/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('sql/' . $value->id . '/edit') }}">&Auml;ndern</a>

                <!-- delete the myinput (uses the destroy method DESTROY /myinputs/{id} -->
                <form action="./sql/{{$value->id }}"  onsubmit="return confirm('Wollen sie wirklich löschen? {{ $value->string}}')" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-btn fa-trash">Löschen</i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
	 {x!x! $sql->render() !x!x}
</div>
@endsection
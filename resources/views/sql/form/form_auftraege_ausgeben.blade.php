@extends('layouts.app')


@section('head')

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>        
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript" class="init">

    $(document).ready( function () {
        $.noConflict();
       


        $('#example').DataTable({
            "lengthMenu": [[100, 250, 500, -1], [100, 250, 500, "All"]],
            "paging": true,
            "columnDefs": [
                {
                    "targets": [ 2 ],
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [ 5 ],
                    "visible": false
                }
            ],
            "language": {
                "lengthMenu": "Zeige _MENU_ Datesätze pro Seite",
                "zeroRecords": "Keine Datensätze gefunden!",
                "info": "Zeige Seite _PAGE_ von _PAGES_",
                "infoEmpty": "Keine Datensätze vorhanden",
                "infoFiltered": "(gefiltert von _MAX_ total Datensätzen)",
                "search": "Suche"
            },
            initComplete: function () {
                this.api().columns('.search').every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );
        
    

    } );


    function buildTable(name, data){
        $('#'+name).append('<table class="dataTable" id="tb_'+name+'" style="width:100%"></table>');



        var table = $('#tb_'+name);
        var json = {!! $options !!};

        table.append('<thead></thead>');
        var s = '<tr>';
        json.Felder.forEach(function (spalte){
            s = s + '<th>' + spalte.displayname + '</th>' ;
        });
        s = s + '</tr>';
        
        $('#tb_'+name+' thead').append(s);

        

        $('#tb_'+name).append('<tbody></tbody>');

        table = $('#tb_'+name+' tbody');
        var json = {!! $options !!};
        data.forEach(function (element){
            s = '<tr>';
            json.Felder.forEach(function (spalte){
                s = s + '<td>' + element[spalte.name] + '</td>';
            });
            s = s + '</tr>'
            table.append( s );
        });
        Change_Language(name);
    }

    function Change_Language(name){
        $('#tb_'+name).DataTable({
            "lengthMenu": [[100, 250, 500, -1], [100, 250, 500, "All"]],
            "paging": true,
            "columnDefs": [
                {
                    "targets": [ 2 ],
                    "visible": true,
                    "searchable": true
                },
                {
                    "targets": [ 5 ],
                    "visible": false
                }
            ],
            "language": {
                "lengthMenu": "Zeige _MENU_ Datesätze pro Seite",
                "zeroRecords": "Keine Datensätze gefunden!",
                "info": "Zeige Seite _PAGE_ von _PAGES_",
                "infoEmpty": "Keine Datensätze vorhanden",
                "infoFiltered": "(gefiltert von _MAX_ total Datensätzen)",
                "search": "Suche"
            },
            initComplete: function () {
                this.api().columns('.search').every( function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );
    };


</script>

@endsection

@section('content')

<div class="container">
    <div class="row">
        <nav class="navbar navbar-inverse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::Route('sql.index') }}">Alle SQL-Anweisungen anzeigen</a></li>
                </ul>
            </nav>
    </div>

    <div class="row">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/sql/create') }}">
                {{ csrf_field() }}
            
                <div class="form-group{{ $errors->has('sql_id') ? ' has-error' : '' }}">
                    <label for="sql_id" class="col-md-4 control-label">Kurzbezeichnung</label>

                    <div class="col-md-6">
                        <input id="masterrecid" type="text" class="form-control" name="kurzbezeichnung" value="{{ old('kurzbezeichnung') }}" >

                        @if ($errors->has('kurzbezeichnung'))
                            <span class="help-block">
                                <strong>{{ $errors->first('kurzbezeichnung') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="anweisung">SQL-Anweisung</label>
                    <textarea class="form-control" id="anweisung" rows="6" name="anweisung">{{$sqlanweisung}}</textarea>
                  </div>		
                
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Ausführen
                        </button>
                    </div>
                </div>
            </form>        

            <table id="example" class="table-stripe" style="width:100%">
                <thead>
                    <tr>
                        <th class="search">AB</th>
                        <th>Auftrag-Nr</th>
                        <th>Kunden-Nr</th>
                        <th>Name</th>
                        <th class="search">Status</th>
                        <th>Angelegt von</th>
                        <th>Angelegt von</th>
                        <th>Angelegt am</th>
                        <th>Verladedatum</th>
                        <th>ExtBestNr</th>
                        <th class="search">LfRtGrund</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>AB</th>
                        <th>Auftrag-Nr</th>
                        <th>Kunden-Nr</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Angelegt von</th>
                        <th>Angelegt von</th>
                        <th>Angelegt am</th>
                        <th>Verladedatum</th>
                        <th>ExtBest-Nr</th>
                        <th>Lf/Rt-Grund</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $item)
                    <tr class="item{{$item->AuftragNr}}">
                        <td>{{$item->AB}}</td>
                        <td>{{$item->AuftragNr}}</td>
                        <td>{{$item->KundenNr}}</td>
                        <td>{{$item->Name}}</td>
                        <td>{{$item->Status}}</td>
                        <td>{{$item->AngelegtVon}}</td>
                        <td>{{$item->AngelegtName}}</td>
                        <td>{{$item->AngelegtAm}}</td>
                        <td>{{$item->Verladedatum}}</td>
                        <td>{{$item->ExtBestNr}}</td>
                        <td>{{$item->LfRtGrund}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="tneu"></div>
            <script>
                // buildTable('tneu', @json($data));
            </script>



    </div>
</div>

@endsection

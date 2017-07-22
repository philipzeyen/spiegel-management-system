@extends('layouts.app')

@section('main-content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h2>
                Masken
                <span style="float: right">
                    <a class="btn btn-success" href="{{ url('maske/create') }}">
                        <span class="glyphicon glyphicon-plus"></span>
                        Neue Maske erstellen
                    </a>
                </span>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach($masken as $maske)
                <hr>
                <div class="my-list-inline">
                    <div>
                        {{ $maske->name_maske }}
                    </div>
                    <div class="buttons">
                        <button type="button" class="btn btn-primary" aria-label="Anzeigen" data-target-canvas='#canvas_{{ $maske->name_maske }}' data-toggle="modal" data-target="#showMaskeModal{{ $maske->masken_id }}">
                            <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> Anzeigen
                        </button>

                        <a href="{{ url('maske/edit', [$maske->masken_id]) }}" class="btn btn-warning" aria-label="Bearbeiten">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Bearbeiten
                        </a>

                        <a href="{{ url('maske/delete', [$maske->masken_id]) }}" class="btn btn-danger" aria-label="Löschen">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Löschen
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="showMaskeModal{{ $maske->masken_id }}" tabindex="-1" role="dialog" aria-labelledby="showMaskeModal{{ $maske->masken_id }}">
                    <div class="modal-dialog" role="document" style="width: 900px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">
                                    {{ $maske->name_maske }}
                                    <span style="font-size: 1.0rem">(Letzte Änderung: {{ $maske->updated_at }})</span>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <canvas id='canvas_{{ $maske->name_maske }}' width='870' height='600' class="masken_canvas non-edit" data-punkte-json='{"uv": [0.11, 0.112, 0.111, 0.114]}' data-maske-url='http://phrogz.net/tmp/gkhead.jpg'></canvas>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('layouts.success')
    @include('layouts.error')
</div>
@endsection
@extends('layouts.app')

@section('main-content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h2>
                Stelen im Einsatz
                <span style="float: right">
                    <a class="btn btn-success" href="{{ url('stele/create') }}">
                        <span class="glyphicon glyphicon-plus"></span>
                        Neue Stele erstellen
                    </a>
                </span>
            </h2>
        </div>
    </div>
    @if(isset($stelen_aktiv) && !empty($stelen_aktiv) && $stelen_aktiv->count() > 0)
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <caption><h4>Aktive Stelen</h4></caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name der Stele</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stelen_aktiv as $stele)
                    <tr>
                        <td>
                            {{ $stele->stelen_id }}
                        </td>
                        <td>
                            {{ $stele->name_stele }}
                        </td>
                        <td class="text-right">
                            <button type="button" class="btn btn-primary" aria-label="Bearbeiten" data-toggle="modal" data-target="#showSteleModal{{ $stele->stelen_id }}">
                                <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> Anzeigen
                            </button>
                            
                            <a href="{{ url('stele/edit', [$stele->stelen_id]) }}" class="btn btn-warning" aria-label="Bearbeiten">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Bearbeiten
                            </a>
                            
                            <a href="{{ url('stele/delete', [$stele->stelen_id]) }}" class="btn btn-danger" aria-label="Bearbeiten">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Löschen
                            </a>
                        </td>
                        <div class="modal fade" id="showSteleModal{{ $stele->stelen_id }}" tabindex="-1" role="dialog" aria-labelledby="showSteleModal{{ $stele->stelen_id }}">
                            <div class="modal-dialog" role="document" style="width: 900px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            {{ $stele->name_stele }}
                                            <span style="font-size: 1.0rem">(Letzte Änderung: {{ $stele->updated_at }})</span>
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        @if($stele::has('config') && isset($stele->config) && !empty($stele->config))
                                            <pre>{{ $stele->config->config_json }}</pre>
                                            @if($stele->config::has('maskenRefs') && isset($stele->config->maskenRefs)
                                                && !empty($stele->config->maskenRefs) && $stele->config->maskenRefs->count() > 0)
                                                
                                                @foreach($stele->config->maskenRefs as $ref)
                                                    @if($ref::has('maske') && isset($ref->maske) && !empty($ref->maske) )
                                                        <div>
                                                            <canvas id='canvas_{{ $maske->name_maske }}' width='870' height='600' class="masken_canvas non-edit" data-punkte-json='{{ $maske->punkte }}' data-maske-url='{{ $maske->bilddatei }}'></canvas>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                            
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    
    @if(isset($stelen_inaktiv) && !empty($stelen_inaktiv) && $stelen_inaktiv->count() > 0)
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <caption><h4>Inaktive Stelen</h4></caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name der Stele</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stelen_inaktiv as $stele)
                    <tr>
                        <td>
                            {{ $stele->stelen_id }}
                        </td>
                        <td>
                            {{ $stele->name_stele }}
                        </td>
                        <td class="text-right">
                            <button type="button" class="btn btn-primary" aria-label="Bearbeiten" data-toggle="modal" data-target="#showSteleModal{{ $stele->stelen_id }}">
                                <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> Anzeigen
                            </button>
                            
                            <a href="{{ url('stele/edit', [$stele->stelen_id]) }}" class="btn btn-warning" aria-label="Bearbeiten">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Bearbeiten
                            </a>
                            
                            <a href="{{ url('stele/delete', [$stele->stelen_id]) }}" class="btn btn-danger" aria-label="Bearbeiten">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Löschen
                            </a>
                        </td>
                        <div class="modal fade" id="showSteleModal{{ $stele->stelen_id }}" tabindex="-1" role="dialog" aria-labelledby="showSteleModal{{ $stele->stelen_id }}">
                            <div class="modal-dialog" role="document" style="width: 900px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            {{ $stele->name_stele }}
                                            <span style="font-size: 1.0rem">(Letzte Änderung: {{ $stele->updated_at }})</span>
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        @if($stele::has('config') && isset($stele->config) && !empty($stele->config))
                                            <pre>{{ $stele->config->config_json }}</pre>
                                            @if($stele->config::has('maskenRefs') && isset($stele->config->maskenRefs)
                                                && !empty($stele->config->maskenRefs) && $stele->config->maskenRefs->count() > 0)
                                                
                                                @foreach($stele->config->maskenRefs as $ref)
                                                    @if($ref::has('maske') && isset($ref->maske) && !empty($ref->maske) )
                                                        <div>
                                                            <canvas id='canvas_{{ $ref->maske->name_maske }}' width='870' height='600' class="masken_canvas non-edit" data-punkte-json='{{ $ref->maske->punkte }}' data-maske-url='{{ $ref->maske->bilddatei }}'></canvas>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                            
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    
    @include('layouts.success')
    @include('layouts.error')
</div>
@endsection
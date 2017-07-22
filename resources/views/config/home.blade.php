@extends('layouts.app')

@section('main-content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h2>
                Konfigurationen
                <span style="float: right">
                    <a class="btn btn-success" href="{{ url('config/create') }}">
                        <span class="glyphicon glyphicon-plus"></span>
                        Neue Konfiguration erstellen
                    </a>
                </span>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach($configs as $config)
            <hr>
            <div class="my-list-inline">
                <div>
                    {{ $config->config_name }}
                </div>
                <div class="buttons">
                    <button type="button" class="btn btn-primary" aria-label="Bearbeiten" data-toggle="modal" data-target="#showConfigModal{{ $config->config_id }}">
                        <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> Anzeigen
                    </button>
                    
                    <a href="{{ url('config/edit', [$config->config_id]) }}" class="btn btn-warning" aria-label="Bearbeiten">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Bearbeiten
                    </a>

                    <a href="{{ url('config/delete', [$config->config_id]) }}" class="btn btn-danger" aria-label="Bearbeiten">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Löschen
                    </a>
                </div>
            </div>
            <div class="modal fade" id="showConfigModal{{ $config->config_id }}" tabindex="-1" role="dialog" aria-labelledby="showConfigModal{{ $config->config_id }}">
                <div class="modal-dialog" role="document" style="width: 900px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">
                                {{ $config->config_name }}
                                <span style="font-size: 1.0rem">(Letzte Änderung: {{ $config->updated_at }})</span>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <pre>{{ $config->config_json }}</pre>
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
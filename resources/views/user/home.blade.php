@extends('layouts.app')

@section('main-content')
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h2>
                Nutzerkonten
                <span style="float: right">
                    <a class="btn btn-success" href="{{ url('maske/create') }}">
                        <span class="glyphicon glyphicon-plus"></span>
                        Neuen Benutzer erstellen
                    </a>
                </span>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach($users as $user)
                <hr>
                <div class="my-list-inline">
                    <div>
                        {{ $user->name }}
                    </div>
                    <div class="buttons">
                        <button type="button" class="btn btn-primary" aria-label="Bearbeiten" data-toggle="modal" data-target="#showUserModal{{ $user->id }}">
                            <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> Anzeigen
                        </button>

                        <a href="{{ url('user/edit', [$user->id]) }}" class="btn btn-warning" aria-label="Bearbeiten">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Bearbeiten
                        </a>

                        <a href="{{ url('user/delete', [$user->id]) }}" class="btn btn-danger" aria-label="Bearbeiten">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Löschen
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="showUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="showUserModal{{ $user->id }}">
                    <div class="modal-dialog" role="document" style="width: 900px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">
                                    {{ $user->name }}
                                    <span style="font-size: 1.0rem">(Letzte Änderung: {{ $user->updated_at }})</span>
                                </h4>
                            </div>
                            <div class="modal-body">
                                <h4>Stelen die der Nutzer erstellt hat</h4>
                                <ul class="list-group">
                                @if($user->stelen->count() < 1)
                                    <li class="list-group-item list-group-item-danger">Der Nutzer hat noch keine Stelen erstellt</li>
                                @else
                                    @foreach($user->stelen as $stele)
                                        <a href="{{ url('stele/edit', [$stele->stelen_id]) }}" class="list-group-item">{{ $stele->stelen_id }} || {{ $stele->name_stele }} || {{ $stele->standort }}</a>
                                    @endforeach
                                @endif
                                </ul>
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
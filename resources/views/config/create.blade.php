@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <h2>Konfiguration erstellen</h2>
        <form action="{{ url('config/create') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="configName" class="control-label">Name der Konfiguration</label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-bookmark"></span>
                    <input type="text" class="form-control" placeholder="Name der Konfiguration" value="{{ old('configName') }}" name="configName" id="configName" required>
                </div>
            </div>
            <hr>
            <h4>Werte der ConfigJson</h4>
            
            <div class="form-group">
                <label for="title" class="control-label">Title</label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-tag"></span>
                    <input type="text" class="form-control" placeholder="Spiegel der Evolution" value="{{ old('title') }}" name="title" id="title" required>
                </div>
            </div>
            <div class="form-group">
                <label for="configName" class="control-label">Masks</label>
                <select class="form-control" name="masks[]" id="masks" multiple required>
                    @foreach($masken as $maske)
                    <option @if(in_array($maske->name_maske, old('masks', []))) selected @endif value="{{ $maske->name_maske }}">{{ $maske->name_maske }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="windowWidth" class="control-label">window.width</label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-resize-horizontal"></span>
                    <input type="number" class="form-control" min="1" value="{{ old('windowWidth', 1) }}" name="windowWidth" id="windowWidth" required>
                </div>
            </div>
            <div class="form-group">
                <label for="windowHeight" class="control-label">window.height</label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-resize-vertical"></span>
                    <input type="number" class="form-control" min="1" value="{{ old('windowHeight', 1) }}" name="windowHeight" id="windowHeight" required>
                </div>
            </div>
            <div class="checkbox">
                <label class="control-label">
                    <input type="checkbox" @if(true == old('windowHideCursor', false)) checked @endif value="{{ old('windowHideCursor', false)  }}" name="windowHideCursor" id="windowHideCursor">
                    window.hideCursor
                </label>
            </div>
            <div class="checkbox">
                <label class="control-label">
                    <input type="checkbox" @if(true == old('windowFullscreen', false)) checked @endif value="{{ old('windowHideCursor', false)  }}" name="windowFullscreen" id="windowFullscreen">
                    window.fullscreen
                </label>
            </div>
            <div class="form-group" class="control-label">
                <label for="connectionHeartbeatInterval">connection.heartbeatInterval</label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-time"></span>
                    <input type="number" class="form-control" min="1" max="300" value="{{ old('connectionHeartbeatInterval', 120) }}" name="connectionHeartbeatInterval" id="connectionHeartbeatInterval" required>
                </div>
            </div>
            <div class="form-group" class="control-label">
                <label for="connectionSocialSharingUploadPath">connection.socialSharingUploadPath</label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-upload"></span>
                    <input type="text" class="form-control" placeholder="https://www.zoom-erlebniswelt.de/spiegel_der_evolution/upload.php" value="{{ old('connectionSocialSharingUploadPath', 'https://www.zoom-erlebniswelt.de/spiegel_der_evolution/upload.php') }}" name="connectionSocialSharingUploadPath" id="connectionSocialSharingUploadPath" required>
                </div>
            </div>

            @include('layouts.error')

            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Speichern</button>
            <a href="{{ url()->previous() }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Abbrechen</a>
        </form>
    </div>
</div>
@endsection
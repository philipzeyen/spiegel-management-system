@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <h2>Stele erstellen</h2>
        <form action="{{ url('maske/create') }}" method="POST">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label class="control-label" for="stele_name">Name der Stele: </label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-bookmark"></span>
                    <input class="form-control" value="{{ old('stele_name', '') }}" type="text" id="stele_name" name="stele_name" />
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label" for="stele_standort">Standort der Stele</label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-map-marker"></span>
                    <input class="form-control" value="{{ old('stele_standort', '') }}" type="text" id="stele_standort" name="stele_standort" />
                </div>
            </div>
            
            <div class="form-group">
                <label for="stele_user_id" class="control-label">Folgendem Nutzer zuordnen: </label>
                <select class="form-control stele_select" name="stele_user_id" id="stele_user_id" required>
                    @foreach($users as $user)
                        <option 
                            @if(in_array($user->id, old('stele_user_id', []))) selected @endif 
                            value="{{ $user->id }}"
                        >
                            {{ $user->name }} ||  {{ $user->email }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="stele_config_id" class="control-label">Folgende Config verwenden: </label>
                <select class="form-control stele_select" name="stele_config_id" id="stele_config_id" required>
                    @foreach($configs as $config)
                        <option 
                            @if(in_array($config->config_id, old('stele_config_id', []))) selected @endif
                            value="{{ $config->config_id }}"
                        >
                            {{ $config->config_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            @include('layouts.error')
            
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Speichern</button>
            <a href="{{ url()->previous() }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Abbrechen</a>
        </form>
    </div>
</div>
@endsection
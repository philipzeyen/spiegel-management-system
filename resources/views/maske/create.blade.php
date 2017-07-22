@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <h2>Maske erstellen</h2>
        <form action="{{ url('maske/create') }}" method="POST" enctype="multipart/form-data">
        <hr>
            {{ csrf_field() }}
            
            <div class="form-group">
                <label class="control-label" for="maske_name">Maskenname: </label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-bookmark"></span>
                    <input class="form-control" type="text" id="maske_name" name="maske_name" value="{{ old('maske_name') }}" />
                </div>
            </div>

            <div class="form-group">
                <label class="control-label" for="maske_bilddatei">Bilddatei der Maske: </label>
                <div class="input-group">
                    <span class="input-group-addon">&</span>
                    <input class="form-control" type="file" id="maske_bilddatei" name="maske_bilddatei" />
                </div>
            </div>
            
<!--            <div class="form-group">
                <label class="control-label" for="maske_json_datei">JSON zur Maske: </label>
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input class="form-control" type="file" id="maske_json_datei" name="maske_json_datei" />
                </div>
            </div>-->

            @include('layouts.error')
            @include('layouts.success')

            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Speichern</button>
            <a href="{{ url()->previous() }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Abbrechen</a>
        </form>
    </div>
</div>
@endsection
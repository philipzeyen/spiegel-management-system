@extends('layouts.app')

@section('main-content')
<div class="row">
    <div class="col-md-12">
        <h2>Benutzer erstellen</h2>
        <form action="{{ url('user/create') }}" method="POST">
        <hr>
            {{ csrf_field() }}
            
            <div class="form-group">
                <label class="control-label" for="user_name">Benutzername:</label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-user"></span>
                    <input class="form-control" type="text" id="user_name" value="{{ old('user_name', '') }}" name="user_name" required minlength="5"/>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label" for="user_email">E-Mailadresse: </label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
                    <input class="form-control" type="email" id="user_email" value="{{ old('user_email', '') }}" name="user_email" required />
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label" for="user_email_confirmation">E-Mailadresse bestätigen: </label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
                    <input class="form-control" type="text" id="user_email_confirmation" name="user_email_confirmation" required />
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label" for="user_password">Passwort</label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-lock"></span>
                    <input class="form-control" type="password" id="user_password" name="user_password" required minlength="6" />
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label" for="user_password_confirmation">Passwort bestätigen: </label>
                <div class="input-group">
                    <span class="input-group-addon glyphicon glyphicon-lock"></span>
                    <input class="form-control" type="password" id="user_password_confirmation" name="user_password_confirmation" required minlength="6" />
                </div>
            </div>
            
            @include('layouts.error')
            
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Speichern</button>
            <a href="{{ url()->previous() }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Abbrechen</a>
        </form>
    </div>
</div>
@endsection
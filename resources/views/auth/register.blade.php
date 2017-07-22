@extends('layouts.app')

@section('main-content')
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">Registrieren</div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-user" id="username_glyph"></span>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" aria-describedby="username_glyph" required autofocus>
                        </div>

                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Addresse</label>

                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-envelope"></span>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Passwort</label>

                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-lock"></span>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Passwort bestätigen</label>

                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon glyphicon glyphicon-lock"></span>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-save"></span>
                            Registrieren
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

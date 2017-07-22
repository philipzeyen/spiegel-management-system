<div class="panel-group" id="sidebar-accordion">

    <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-parent="#sidebar-accordion" href="#collapseStelen">
            <h4 class="panel-title">
                <a >
                    <span class="glyphicon glyphicon-hdd"></span>Stele
                </a>
            </h4>
        </div>
        <div id="collapseStelen" class="panel-collapse collapse {{ (Request::is('stele*') || Request::is('home*') ? 'in' : '') }}">
            <div class="panel-body">
                <table class="table">
                    <tr onclick="window.location.href='{{ url('stele') }}'" class="{{ (Request::is('home*') || (Request::is('stele*') && !Request::is('stele/create')) ? 'active' : '') }}">
                        <td>
                            <a href="{{ url('stele') }}">
                                <span class="glyphicon glyphicon-edit"></span>
                                Stelen verwalten
                            </a>
                        </td>
                    </tr>
                    <tr class="{{ (Request::is('stele/create') ? 'active' : '') }}" onclick="window.location.href='{{ url('stele/create') }}'">
                        <td>
                            <a href="{{ url('stele/create') }}">
                                <span class="glyphicon glyphicon-plus"></span>
                                Stele erstellen
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-parent="#sidebar-accordion" href="#collapseKonfiguration">
            <h4 class="panel-title">
                <a>
                    <span class="glyphicon glyphicon-file"></span>Konfiguration
                </a>
            </h4>
        </div>
        <div id="collapseKonfiguration" class="panel-collapse collapse {{ (Request::is('config*') ? 'in' : '') }}">
            <div class="panel-body">
                <table class="table">
                    <tr onclick="window.location.href='{{ url('config') }}'" class="{{ (Request::is('config*') && !Request::is('config/create') ? 'active' : '') }}">
                        <td>
                            <a href="{{ url('config') }}">
                                <span class="glyphicon glyphicon-edit"></span>
                                Konfigurationen verwalten
                            </a>
                        </td>
                    </tr>
                    <tr class="{{ (Request::is('config/create') ? 'active' : '') }}" onclick="window.location.href='{{ url('config/create') }}'">
                        <td>
                            <a href="{{ url('config/create') }}">
                                <span class="glyphicon glyphicon-plus"></span>
                                Konfiguration erstellen
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-parent="#sidebar-accordion" href="#collapseMaske">
            <h4 class="panel-title">
                <a>
                    <span class="glyphicon glyphicon-credit-card"></span>Maske
                </a>
            </h4>
        </div>
        <div id="collapseMaske" class="panel-collapse collapse {{ (Request::is('maske*') ? 'in' : '') }}">
            <div class="panel-body">
                <table class="table">
                    <tr onclick="window.location.href='{{ url('maske') }}'" class="{{ (Request::is('maske*') && !Request::is('maske/create') ? 'active' : '') }}">
                        <td>
                            <a href="{{ url('maske') }}">
                                <span class="glyphicon glyphicon-edit"></span>
                                Masken verwalten
                            </a>
                        </td>
                    </tr>
                    <tr class="{{ (Request::is('maske/create') ? 'active' : '') }}" onclick="window.location.href='{{ url('maske/create') }}'">
                        <td>
                            <a href="{{ url('maske/create') }}">
                                <span class="glyphicon glyphicon-plus"></span>
                                Maske erstellen
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    @if(auth()->user()->name == 'admin')
    <div class="panel panel-default">
        <div class="panel-heading" data-toggle="collapse" data-parent="#sidebar-accordion" href="#collapseBenutzer">
            <h4 class="panel-title">
                <a >
                    <span class="glyphicon glyphicon-user"></span>Benutzer
                </a>
            </h4>
        </div>
        <div id="collapseBenutzer" class="panel-collapse collapse {{ (Request::is('user*') ? 'in' : '') }}">
            <div class="panel-body">
                <table class="table">
                    <tr onclick="window.location.href='{{ url('user') }}'" class="{{ (Request::is('user*') && !Request::is('user/create') ? 'active' : '') }}">
                        <td>
                            <a href="{{ url('user') }}">
                                <span class="glyphicon glyphicon-edit"></span>
                                Benutzer verwalten
                            </a>
                        </td>
                    </tr>
                    <tr class="{{ (Request::is('user/create') ? 'active' : '') }}" onclick="window.location.href='{{ url('user/create') }}'">
                        <td>
                            <a href="{{ url('user/create') }}">
                                <span class="glyphicon glyphicon-plus"></span>
                                Benutzer erstellen
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

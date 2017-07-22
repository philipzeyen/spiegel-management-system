@if (count(session('status')) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-alert"></span>
            <ul>
                @foreach (session('status') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
        <div class="col-md-6 col-md-offset-3 flash-message">
            <p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}</p>
        </div>
    @endif
@endforeach
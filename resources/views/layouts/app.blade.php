@section('app')
    @extends('adminlte::page')

    @section('content_header')
    <div class="d-flex justify-content-between">
        <div>
            <h1>@yield('title')</h1>
        </div>
        <div>
            <a href="@yield('create_route')" class="btn btn-primary"><i class="fas fa-plus"></i> Добавить</a>
        </div>
    </div>
    @stop

    @yield('content')

@endsection

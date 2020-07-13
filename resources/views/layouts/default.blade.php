


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title') | {{  __('main.title') }}
    </title>
@section('description', __('main.title'))

<!-- STYLES -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
<!-- HEADER -->
<header class="header">
    <div class="container">
        @if(Route::currentRouteName() == 'main')
            <div class="header__logo" onclick="window.location.reload();">{{ config('app.name') }}</div>
        @else
            <a class="header__logo" href="{{ url('/') }}" title="@lang('main.title')"> {{ config('app.name') }}</a>
        @endif
        @include('components.menu-main')
        @include('components.menu-auth')
    </div>
</header>

<!-- MAIN -->
<main class="main">
    <!-- SECTION -->
    <section class="section">
        @yield('content')
    </section>

    <!-- ASIDE -->
    <aside class="aside">
        SIDEBAR
    </aside>
</main>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        FOOTER
    </div>
    <div class="footer-copy">
        <p>@lang('main.copyright')</p>
    </div>
</footer>
<div class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document"></div>
</div>
<!-- SCRIPTS -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>


















{{--<div class="menu-auth">--}}
{{--<ul class="menu-auth__list">--}}
{{--@guest--}}
{{--<li class="menu-auth__item">--}}
{{--<a href="{{ route('login') }}" class="menu-auth__link ajax" data-url="{{ route('login') }}" data-name="Войти" data-modal-size="modal-sm">--}}
{{--@lang('menu.login')--}}
{{--</a>--}}
{{--</li>--}}
{{--@if (Route::has('register'))--}}
{{--<li class="menu-auth__item">--}}
{{--<a href="{{ route('register') }}" class="menu-auth__link">--}}
{{--@lang('menu.register')--}}
{{--</a>--}}
{{--</li>--}}
{{--@endif--}}
{{--@else--}}
{{--<li class="menu-auth__item">--}}
{{--<a href="{{ route('user.profile', Auth::user()->route ?? Auth::user()->username) }}" class="menu-auth__link">--}}
{{--{{ Auth::user()->username }}--}}
{{--</a>--}}
{{--</li>--}}
{{--<li class="menu-auth__item">--}}
{{--<a href="{{ route('logout') }}" class="menu-auth__link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
{{--@lang('menu.logout')--}}
{{--</a>--}}
{{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--@csrf--}}
{{--</form>--}}
{{--</li>--}}
{{--@endguest--}}
{{--</ul>--}}
{{--</div>--}}
@include('components.users.user-menu-header')
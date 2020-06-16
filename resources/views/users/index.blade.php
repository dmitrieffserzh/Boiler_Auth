@extends('layouts.default')

@section('content')
    <div class="content-header">
        <div class="content-header__title">
            <h1 class="content-header__title-text">Пользователи</h1>
        </div>
        <ul class="content-header__menu">
            <li class="content-header__menu-item"><a href="#" class="content-header__menu-link content-header__menu-link--active">Рейтинг</a></li>
            <li class="content-header__menu-item"><a href="#" class="content-header__menu-link">Последние</a></li>
            <li class="content-header__menu-item"><a href="#" class="content-header__menu-link">В сети</a></li>
        </ul>
    </div>

    @forelse ($users as $user)
        @include('components.users.user-card', [ 'user' => $user ])
    @empty
        <p>@lang('erors.no-data')</p>
    @endforelse
    <br>
    {{ $users->links() }}
@endsection
@extends('layouts.profile')

@section('profile')
    <img src="{{ UserHelper::get_avatar($user->profile->avatar) }}" alt="" width="100%">
    <h4>{{ $user->username }}</h4>
    @if($user->is_online())
        <div class="user-card__status">онлайн</div>
    @else
        <div class="user-card__status">
            {{ UserHelper::getOnlineTime($user->profile->gender, $user->profile->offline_at->diffForHumans()) }}
        </div>
    @endif
    <div>125</div>
    <div>11</div>
    <div>234</div>

    @if( Auth::id() == $user->id )
        <ul>
            <li><a href="{{ route( 'user.profile.edit', $user->route ?? $user->username ) }}">Изменить профиль</a></li>
        </ul>
    @endif

@endsection



@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h4">Изменить профиль</h1>
                {{ $user->profile->first_name ?? $user->email }} <br>
                {{ $user->route }}
                @include('users.forms._route')
            </div>
        </div>
    </div>
@endsection
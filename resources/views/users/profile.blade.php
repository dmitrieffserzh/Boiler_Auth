@extends('layouts.profile')

@section('profile')
    <style>
        .user-profile:after {
            content: '';
            position: absolute;
            top:  0;
            left: 0;
            right: 0;
            bottom: 0;
            display: block;
        //background-image:linear-gradient( to bottom, rgb(255, 255, 255), rgb(218, 216, 226));
            background-size: cover;
            width: 100%;
            height: 100%;
        }
    </style>
    <div class="user-profile">
        <div class="user-profile__wrap">
            <img src="{{ UserHelper::get_avatar($user->profile->avatar) }}" alt="" width="100%">
            <h4 style="    font-weight: 700;">{{ $user->username }}</h4>
            @if($user->is_online())
                <div class="user-card__status">онлайн</div>
            @else
                <div class="user-card__status">
                    {{ UserHelper::getOnlineTime($user->profile->gender, $user->profile->offline_at->diffForHumans()) }}
                </div>
            @endif

            <div style="font-weight: 900;margin: .5rem 0 0;font-size: 1rem;">125 <span style="color: #f5f5f8;font-size: 1rem;font-weight: 100;display: inline-block;">|</span> 12 <span style="color: #f5f5f8;font-size: 1rem;font-weight: 100;display: inline-block;">|</span> 238</div>


            @if( Auth::id() == $user->id )
                <ul>
                    <li><a href="{{ route( 'user.profile.edit', $user->route ?? $user->username ) }}">Изменить профиль</a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
@endsection


@section('content')

    <br>
    USER PROFILE

@endsection
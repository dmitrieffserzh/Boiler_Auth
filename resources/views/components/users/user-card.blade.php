
<div class="user-card">
    <div class="user-card__photo">
        <a href="{{ route('user.profile', $user->route ?? $user->username) }}" title="{{ $user->username }}">
            <img src="{{ UserHelper::get_avatar($user->profile->avatar) }}" alt="{{ $user->username }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12"
                 fill="{{ $user->is_online() ? '#00d006' : '#bbd0ea' }}" stroke="#fff" stroke-width="2"
                 class="user-card__dot-status">
                <circle cx="6" cy="6" r="5"/>
            </svg>
        </a>
    </div>
    <div class="user-card__info">
        <a class="user-card__name" href="{{ route('user.profile', $user->route ?? $user->username) }}"
           title="{{ $user->username }}">
            {{ $user->username }}
        </a>
        <div class="user-card__status">
            {{ $user->is_online() ? 'онлайн' : UserHelper::getOnlineTime($user->profile->gender, $user->profile->offline_at->diffForHumans()) }}
        </div>
    </div>
</div>
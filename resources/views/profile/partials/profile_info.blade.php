<div class="profile-info-new">
    <img src="{{ asset($user->user_photo) }}" alt="Icono del usuario" class="profile-icon">
    <div class="user-details">
        <h1 class="titular">{{ $user->name }}</h1>
        <div class="account-details d-flex align-items-center flex-wrap">
            @if ($user->nick)
                <div class="account mr-3">
                    <p class="mb-0">{{ '@' . $user->nick }}</p>
                </div>
            @endif
            @if ($user->discord)
                <div class="account d-flex align-items-center mr-3">
                    <i class="fab fa-discord fa-lg text-white mr-2"></i>
                    <p class="mb-0">{{ $user->discord }}</p>
                </div>
            @endif
            @if ($user->twitter)
                <div class="account d-flex align-items-center mr-3">
                    <i class="fab fa-twitter fa-lg text-white mr-2"></i>
                    <p class="mb-0">{{ $user->twitter }}</p>
                </div>
            @endif
            @if ($user->birth_date)
                <div class="account mr-3">
                    <p class="mb-0">{{ date('F jS', strtotime($user->birth_date)) }}</p>
                </div>
            @endif
            @if (auth()->user() && auth()->user()->id != $user->id)
                <div class="account d-flex align-items-center">
                    @php
                        $userFollowing = auth()->user()->isFollowing($user);
                        $userFollowed = $user->isFollowing(auth()->user());
                    @endphp

                    <form
                        action="{{ $userFollowing ? route('unfollow', $user->id) : route('follow', $user->id) }}"
                        method="POST" class="d-flex align-items-center mr-3">
                        @csrf
                        <button type="submit"
                            class="btn {{ $userFollowing ? 'btn-secondary' : 'btn-primary' }}">
                            {{ $userFollowing ? 'Unfollow' : 'Follow' }}
                        </button>
                    </form>

                    @if ($userFollowing && $userFollowed)
                        <span class="ml-2 mutuals"><i class="fas fa-heart text-white"></i> Mutuals</span>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

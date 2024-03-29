<div class="text-center">
    <div class="pb-3 mt-3 border-bottom">
        <img src="/images/{{ $check_user->avatar }}" alt="" class="mb-3 avatar">
        <h2 class="mb-3">{{ $check_user->name }}</h2>
        {{-- The case of Auth user's page  --}}
        @if ($check_user->id == Auth::user()->id)
            <h5 class="mb-3">{{ $check_user->email }}</h5>
            {{-- The case of Auth user's Dashboard  --}}
            @if (Route::currentRouteName() == 'home')
                <a href="{{ route('home.show') }}" class="btn btn-primary mr-2">Your Page</a>
            @endif
            <a href="{{ route('home.edit') }}" class="btn btn-success">Update Profile</a>
        @else
            @include('../partials/follow_button')
        @endif
    </div>
    <div class="p-2 my-3">
        <div class="row border-bottom pb-3">
            <div class="col-md-6">
                <a href="{{ route('user.following', ['user' => $check_user->id]) }}"><h4>{{ $check_user->following()->count() }}</h4></a>
                <h4>Following</h4>
            </div>
            <div class="col-md-6">
                <a href="{{ route('user.followers', ['user' => $check_user->id]) }}"><h4>{{ $check_user->followers()->count() }}</h4></a>
                <h4>Followers</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{-- You can enter words list is belongs to own or your followers. --}}
                @if ($check_user->id == Auth::user()->id || Auth::user()->is_following($check_user->id))
                    <a href="{{ route('user.words', ['user' => $check_user->id]) }}">
                        <div class="py-3 my-3 bg-primary radius text-white">
                            <h4>{{ $check_user->finished_all_no()['all'] }}</h4>
                            <h4>Learned Words</h4>
                        </div>
                    </a>
                @else
                    <div class="py-3 my-3 bg-gray radius">
                        <h4>{{ $check_user->finished_all_no()['all'] }}</h4>
                        <h4>Learned Words</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
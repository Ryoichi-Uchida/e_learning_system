@if(Route::currentRouteName() == 'user.index')

    <a href="{{ route('user.followers', ['user' => Auth::user()->id]) }}" class="btn btn-outline-primary float-right mx-2">Your followers</a>
    <a href="{{ route('user.following', ['user' => Auth::user()->id]) }}" class="btn btn-outline-primary float-right mx-2">Your followings</a>
    <p class="btn btn-primary float-right mx-2">All members</p>
    <h1>All members</h1>

@elseif(Route::currentRouteName() == 'user.following')

    {{-- These buttons Appear only on own list --}}
    @if ($user->id == Auth::user()->id)
        <a href="{{ route('user.followers', ['user' => Auth::user()->id]) }}" class="btn btn-outline-primary float-right mx-2">Your followers</a>
        <p class="btn btn-primary float-right mx-2">Your followings</p>
        <a href="{{ route('user.index') }}" class="btn btn-outline-primary float-right mx-2">All members</a>
        <h1>Your following members</h1>
    @else
        <h1>{{ $user->name }}'s following members</h1>
    @endif

@else

    {{-- These buttons Appear only on own list --}}
    @if($user->id == Auth::user()->id)
        <p class="btn btn-primary float-right mx-2">Your followers</p>
        <a href="{{ route('user.following', ['user' => Auth::user()->id]) }}" class="btn btn-outline-primary float-right mx-2">Your followings</a>
        <a href="{{ route('user.index') }}" class="btn btn-outline-primary float-right mx-2">All members</a>    
        <h1>Your followers</h1>
    @else
        <h1>{{ $user->name }}'s followers</h1>
    @endif

@endif
{{-- It is a component of follow & unfollow button --}}
@if(Auth::user()->id == $user->id)
@elseif (Auth::user()->is_following($user->id))
    <a href="{{ route('user.unfollow',['user' => $user->id]) }}" class="btn btn-danger">Unfollow</a>       
@else
    <a href="{{ route('user.follow', ['user' => $user->id]) }}" class="btn btn-primary">Follow</a>
@endif 
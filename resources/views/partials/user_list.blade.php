@foreach ($users as $user)
    <div class="col-6">
        <div class="user-list border px-3 mx-2 mb-2">
            <img src="/images/{{ $user->avatar }}" alt="" class="avatar">
            <a href="{{ route('user.show', ['user' => $user->id]) }}"><p class="px-3 pt-3">{{ $user->name }}</p></a>                          
            <div class="ml-auto">
                @include('../partials/follow_button')
            </div>   
        </div>
    </div>
@endforeach
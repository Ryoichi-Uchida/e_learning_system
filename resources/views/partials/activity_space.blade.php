{{-- This blade partials consist of 3 parts. --}}
{{-- 1.Dashboard --}}
{{-- 2.Own Profile --}}
{{-- 3.Other's profile --}}

{{-- Dashboard --}}
@if(Route::currentRouteName() == 'home')
    @foreach($activities as $activity)
        <div class="bg-white border p-3 m-3">
            <div class="row">
                <div class="col-2">
                    <img src="/images/{{ $activity->user()->avatar }}" alt="" class="avatar">
                </div>
                <div class="col-10">
                    {{-- Follow --}}
                    @if($activity->activity_type == 'follow')
                        {{-- Subject --}}
                        @if($activity->user()->id == Auth::user()->id)
                            <h4>You</h4>
                        @else
                            <a href="{{ route('user.show', ['user' => $activity->user()->id]) }}"><h4>{{ $activity->user()->name }}</h4></a>
                        @endif
                        {{-- Verb & Object --}}
                        @if($activity->activity->user->id == Auth::user()->id)
                            <h4>Followed You</h4>
                        @else
                            <h4>Followed <a href="{{ route('user.show', ['user' => $activity->activity->user->id]) }}" class="bg-success text-white p-1 rounded">{{ $activity->activity->user->name }}</a></h4>
                        @endif
                    {{-- Lesson --}}
                    @else
                        {{-- Subject --}}
                        @if($activity->user()->id == Auth::user()->id)
                            <h4>You</h4>
                        @else
                            <a href="{{ route('user.show', ['user' => $activity->activity->user->id]) }}"><h4>{{ $activity->activity->user->name }}</h4></a>    
                        @endif
                        {{-- You can check other's lesson detail after follow --}}
                        @if(Auth::user()->is_following($activity->user()->id) || $activity->user()->id == Auth::user()->id)
                            <h4>learned <a href="{{ route('lesson.result', ['user' => $activity->user()->id, 'category' => $activity->activity->category->id]) }}" class="bg-primary text-white p-1 rounded">{{ $activity->activity->category->title }}</a></h4>
                        @else
                            <h4>learned <span class="p-1">{{ $activity->activity->category->title }}</span></h4>
                            <span class="text-danger float-right mr-1 h5">Let's follow this user to check the Activity detail !!</span>
                        @endif
                    @endif
                    <p>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->created_at))->diffForHumans() }}</p>
                </div>
            </div>
        </div>  
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $activities->links() }}
    </div>

{{-- Own profile --}}
@elseif(Route::currentRouteName() == 'home.show')
    @foreach($activities as $activity)
        <div class="bg-white border pt-3 pl-3 m-3">
            {{-- Follow --}}
            @if($activity->activity_type == 'follow')
                <h4>You Followed <a href="{{ route('user.show', ['user' => $activity->activity->user->id]) }}" class="bg-success text-white p-1 rounded">{{ $activity->activity->user->name }}</a></h4>
            {{-- Lesson --}}
            @else
                <h4>You learned <a href="{{ route('lesson.result', ['user' => Auth::user()->id, 'category' => $activity->activity->category->id]) }}" class="bg-primary text-white p-1 rounded">{{ $activity->activity->category->title }}</a></h4>
            @endif
            <p>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->created_at))->diffForHumans() }}</p>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $activities->links() }}
    </div>

{{-- Other's profile --}}
@else
    {{-- The case this user has some activities --}}
    @if(!empty($activities->first()))
        @foreach($activities as $activity)
            <div class="bg-white border pt-3 pl-3 m-3">
                {{-- Follow --}}
                @if($activity->activity_type == 'follow')
                    <h4>{{ $user->name }} Followed <a href="{{ route('user.show', ['user' => $activity->activity->user->id]) }}" class="bg-success text-white p-1 rounded">{{ $activity->activity->user->name }}</a></h4>
                {{-- Lesson --}}
                @else
                    {{-- You can see other's activities after follow --}}
                    @if(Auth::user()->is_following($user->id))
                        <h4>{{ $user->name }} learned <a href="{{ route('lesson.result', ['user' => $user->id, 'category' => $activity->activity->category->id]) }}" class="bg-primary text-white p-1 rounded">{{ $activity->activity->category->title }}</a></h4>
                    @else
                    <h4>{{ $user->name }} learned <span class="text-primary p-1">{{ $activity->activity->category->title }}</span></h4>
                    <span class="text-center text-danger float-right mr-3 h5">Let's follow this user to check Lesson detail & Words !!</span>
                    @endif
                @endif
                <p>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($activity->created_at))->diffForHumans() }}</p>
            </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{ $activities->links() }}
        </div>
    @else
        <h3 class="text-center text-danger">{{ $user->name }} doesn't have activity yet..</h3>
    @endif
@endif
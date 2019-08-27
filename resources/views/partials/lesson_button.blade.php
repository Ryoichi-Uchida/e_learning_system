@if(Route::currentRouteName() == 'lesson.index')

    <a href="{{ route('lesson.unlearned_index') }}" class="btn btn-outline-primary float-right mx-2">Unlearned</a>
    <a href="{{ route('lesson.learned_index') }}" class="btn btn-outline-primary float-right mx-2">Learned</a>
    <p class="btn btn-primary float-right mx-2">All</p>
    <h1>Lesson list</h1>

@elseif(Route::currentRouteName() == 'lesson.learned_index')

    <a href="{{ route('lesson.unlearned_index') }}" class="btn btn-outline-primary float-right mx-2">Unlearned</a>
    <p class="btn btn-primary float-right mx-2">Learned</p>
    <a href="{{ route('lesson.index') }}" class="btn btn-outline-primary float-right mx-2">All</a>
    <h1>Learned list</h1>

@else

    <p href="" class="btn btn-primary float-right mx-2">Unlearned</p>
    <a href="{{ route('lesson.learned_index') }}" class="btn btn-outline-primary float-right mx-2">Learned</a>
    <a href="{{ route('lesson.index') }}" class="btn btn-outline-primary float-right mx-2">All</a>
    <h1>Unlearned list</h1>

@endif

@if(Route::currentRouteName() == 'lesson.index')

    {{-- The case this category is finished  --}}
    @if(Auth::user()->is_lesson_starting($category->id) && Auth::user()->finished_question_no($category->id) == $category->questions->count())
        <div class="col-6">
            <div class="border p-3 mb-4 lesson-list">
                <h2>{{ $category->title }}</h2>
                <p>{{ $category->description }}</p>
                <div class="text-right">
                    <a href="{{ route('lesson.result', ['category' => $category->id]) }}" class="btn btn-outline-secondary">Your Result</a>
                </div>
            </div>
        </div>
    {{-- The case this category is on the way  --}}
    @elseif(Auth::user()->is_lesson_starting($category->id) && Auth::user()->finished_question_no($category->id) != $category->questions->count())
        <div class="col-6">
            <div class="border p-3 mb-4 lesson-list">
                <h2>{{ $category->title }}</h2>
                <p>{{ $category->description }}</p>
                <div class="text-right">
                    <a href="{{ route('lesson.question_show', ['category' => $category->id]) }}" class="btn btn-success">Resume</a>
                </div>
            </div>
        </div>
    {{-- The case this category is finished --}}
    @else
        <div class="col-6">
            <div class="border p-3 mb-4 lesson-list">
                <h2>{{ $category->title }}</h2>
                <p>{{ $category->description }}</p>
                <div class="text-right">
                    <a href="{{ route('lesson.question_show', ['category' => $category->id]) }}" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>
    @endif

@elseif(Route::currentRouteName() == 'lesson.learned_index')

    {{-- The case this category is finished  --}}
    @if(Auth::user()->is_lesson_starting($category->id) && Auth::user()->finished_question_no($category->id) == $category->questions->count())
        <div class="col-6">
            <div class="border p-3 mb-4 lesson-list">
                <h2>{{ $category->title }}</h2>
                <p>{{ $category->description }}</p>
                <div class="text-right">
                    <a href="{{ route('lesson.result', ['category' => $category->id]) }}" class="btn btn-outline-secondary">Your Result</a>
                </div>
            </div>
        </div>
    @endif

@else

    {{-- The case this category is on the way  --}}
    @if(Auth::user()->is_lesson_starting($category->id) && Auth::user()->finished_question_no($category->id) != $category->questions->count())
        <div class="col-6">
            <div class="border p-3 mb-4 lesson-list">
                <h2>{{ $category->title }}</h2>
                <p>{{ $category->description }}</p>
                <div class="text-right">
                    <a href="{{ route('lesson.question_show', ['category' => $category->id]) }}" class="btn btn-success">Resume</a>
                </div>
            </div>
        </div>
    {{-- The case user isn't starting this category yet  --}}
    @elseif(Auth::user()->is_lesson_starting($category->id) == false)
        <div class="col-6">
            <div class="border p-3 mb-4 lesson-list">
                <h2>{{ $category->title }}</h2>
                <p>{{ $category->description }}</p>
                <div class="text-right">
                    <a href="{{ route('lesson.question_show', ['category' => $category->id]) }}" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>
    @endif

@endif
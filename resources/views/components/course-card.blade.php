<article class="course-card">
    <img src="{{ asset('images/dataPic.png') }}" 
         alt="{{ $course->title }}" 
         class="course-image" />

    <!-- Rating -->
    <div class="course-rating">
        <img src="{{ asset('images/starSymbol.png') }}" 
             alt="Rating Stars" 
             width="78" 
             height="14" />
        <span>{{ $course->rating ?? '4.5' }} ★</span>
    </div>

    <!-- Title -->
    <h3 class="course-title">
        {{ Str::limit($course->title, 45, '...') }}
    </h3>

    <!-- Meta -->
    <div class="course-meta">
        <span>
            <img src="{{ asset('images/timeSymbol.png') }}" 
                 alt="Duration" 
                 width="18" />
            {{ $course->duration ?? '—' }}
        </span>

        <span>
            <img src="{{ asset('images/user.png') }}" 
                 alt="Students" 
                 width="18" />
            {{ $course->students_count ?? '0' }} Students
        </span>
    </div>
</article>

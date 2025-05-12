@php
    $group = $user->group;
    $course = $group?->course;
    $faculty = $course?->faculty;
    $university = $faculty?->university;
@endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">University</h2>
        <p class="mt-2 mb-4 text-md text-gray-600">{{ $university?->name_university ?? '—' }}</p>

        <h2 class="text-lg font-medium text-gray-900">Faculty</h2>
        <p class="mt-2 mb-4 text-md text-gray-600">{{ $faculty?->name_faculty ?? '—' }}</p>

        <h2 class="text-lg font-medium text-gray-900">Course</h2>
        <p class="mt-2 mb-4 text-md text-gray-600">{{ $course?->name_course ?? '—' }}</p>

        <h2 class="text-lg font-medium text-gray-900">Group</h2>
        <p class="mt-2 mb-4 text-md text-gray-600">{{ $group?->name_group ?? '—' }}</p>
    </header>
</section>

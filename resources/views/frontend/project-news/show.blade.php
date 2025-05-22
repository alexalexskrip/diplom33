@include('includes.header')

<main>
    <div class="container my-5">
        <x-breadcrumbs :items="[
            ['title' => 'Главная', 'url' => route('frontend.home')],
            ['title' => 'Новости проекта / ' . $news->project->name . ' / ' . $news->name]
        ]"/>

        <h1>{{ $news->name }}</h1>

        <div class="mt-4">
            {{ $news->description }}
        </div>

        <div class="mt-4">
            <span class="fw-medium">Проект:</span> {{ $news->project->name }}
        </div>
    </div>
</main>

@include('includes.footer')

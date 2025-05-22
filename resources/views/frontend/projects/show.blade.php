@include('includes.header')

<main>
    <div class="container my-5">
        <x-breadcrumbs :items="[
            ['title' => 'Главная', 'url' => route('frontend.home')],
            ['title' => 'Проекты / ' . $project->name]
        ]"/>

        <h1>{{ $project->name }}</h1>

        <div class="mt-4">
            <h2 class="mb-2">Студенты:</h2>

            @foreach($project->users as $student)
                <p class="my-0 py-0">{{ $student->fullname }}</p>
            @endforeach
        </div>

        <div class="mt-4">
            <h2 class="mb-2">Описание проекта:</h2>

            <div>
                {{ $project->description }}
            </div>
        </div>

        @php
            $images = $project->getMedia('images');
        @endphp

        @if($images->count())
            <div class="mt-4">
                <h2 class="mb-2">Фотографии:</h2>

                <div class="row g-4">
                    @foreach($images as $media)
                        <div class="col-6 col-md-3">
                            <img src="{{ $media->getUrl() ?? asset('images/no_photo.jpg') }}" alt="Image" class="img-fluid rounded shadow-sm">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @php
            $documents = $project->getMedia('documents');
        @endphp

        @if($documents->count())
            <div class="mt-4">
                <h2 class="mb-2">Документы:</h2>

                <ul class="list-group">
                    @foreach($documents as $media)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ $media->getUrl() }}" target="_blank" class="text-decoration-none text-primary">
                                {{ $media->file_name ?? basename($media->getPath()) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php
            $videos = $project->getMedia('videos');
        @endphp

        @if($videos->count())
            <div class="mt-4">
                <h2 class="mb-2">Видео:</h2>

                <div class="row g-4">
                    @foreach($videos as $media)
                        <div class="col-6 col-md-3">
                            <video controls class="w-100 rounded shadow-sm">
                                <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
                                Ваш браузер не поддерживает видео.
                            </video>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</main>

@include('includes.footer')

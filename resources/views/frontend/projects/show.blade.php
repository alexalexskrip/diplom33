@include('includes.header')

<main>
    <div class="container my-5">
        <h1>{{ $project->name_project }}</h1>

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

        @if($project->media)
            <div class="mt-4">
                <h2 class="mb-2">Фотографии:</h2>

                <div class="row g-4">
                    @foreach($project->media as $medium)
                        <div class="col-6 col-md-3">
                            <img src="{{ $medium->file_path ? asset('storage/projectmedia/' . $medium->file_path) : asset('images/no_photo.jpg') }}" alt="Image" class="img-fluid rounded shadow-sm">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</main>

@include('includes.footer')

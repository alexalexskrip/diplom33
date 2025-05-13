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
                {{ $project->discription_project }}
            </div>
        </div>

        @if($project->medias)
            <div class="mt-4">
                <h2 class="mb-2">Фотографии:</h2>

                <div class="row g-4">
                    @foreach($project->medias as $medium)
                        <div class="col-6 col-md-3">
                            <img src="{{ $medium->File_ProjectMedia ? asset('storage/projectmedia/' . $medium->File_ProjectMedia) : asset('images/no_photo.jpg') }}" alt="Image" class="img-fluid rounded shadow-sm">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</main>

@include('includes.footer')

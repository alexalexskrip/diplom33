@include('includes.header')

<main>
    <div class="container my-5">
        <h1>Новости проекта</h1>

        <div class="mt-4">
            @foreach ($projectNews as $news)
                <div class="mb-5">
                    <p class="mb-1 text-muted text-sm">{{ $news->created_at->format('d.m.Y') }}</p>
                    <h5 class="mb-1 fw-bold">{{ $news->name }}</h5>
                    <p>{{ Str::limit($news->description, 200) }}</p>

                    @if ($news->project)
                        <p class="mt-2 mb-0">
                            <span class="badge bg-secondary">{{ $news->project->name }}</span>
                        </p>
                    @endif

                    <a href="{{ route('frontend.project-news.show', $news) }}" class="btn btn-sm btn-outline-primary mt-3">
                        Читать полностью
                    </a>
                </div>
            @endforeach

            <div class="d-flex justify-content-center">
                {{ $projectNews->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</main>

@include('includes.footer')

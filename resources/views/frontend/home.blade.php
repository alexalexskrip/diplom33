@include('includes.header')

<script>
    window.__sliderData = {
        votes: @json($formattedVotesProjects->values()->all()),
        review: @json($formattedReviewProjects->values()->all()),
        accepted: @json($formattedAcceptedProjects->values()->all()),
        news: @json($formattedNews->values()->all())
    };

    document.addEventListener('alpine:init', () => {
        Alpine.data('sliderData', (type = 'votes') => ({
            items: window.__sliderData[type] ?? [],
            currentStart: 0,
            visibleCount: 3,

            visibleItems() {
                return this.items.slice(this.currentStart, this.currentStart + this.visibleCount);
            },

            next() {
                if (this.currentStart + this.visibleCount < this.items.length) this.currentStart++;
            },

            prev() {
                if (this.currentStart > 0) this.currentStart--;
            }
        }));
    });
</script>

<script>
    console.log("votes", window.__sliderData.votes);
    console.log("review", window.__sliderData.review);
    console.log("accepted", window.__sliderData.accepted);
</script>

<main>
    <div class="container" x-data="sliderData('votes')" x-init="true">
        <p class="my-text-muted">Всего инициатив: {{ $formattedVotesProjects->count() }}</p>

        <div class="d-flex justify-content-between mb-5">
            <h1>Инициативы на голосовании</h1>
            <div class="d-flex justify-content-between align-items-center">
                <a class="slide_btn" href="#" @click.prevent="prev"><i class="fa-solid fa-caret-left"></i></a>
                <a class="slide_btn" href="#" @click.prevent="next"><i class="fa-solid fa-caret-right"></i></a>
            </div>
        </div>

        <div class="posts row">
            <template x-for="(project, index) in visibleItems()" :key="index">
                <div class="col-sm-12 col-lg-4 mb-3">
                    <div class="post position-relative d-flex flex-column h-100" :class="project.bgClass">

                        <!-- Верхняя часть -->
                        <div class="p-4">
                            <div class="d-flex mb-3 flex-wrap gap-2">
                                <div class="tag" x-text="project.author"></div>
                                <div class="tag" x-text="project.group"></div>
                            </div>
                            <h2><a :href="project.link" x-text="project.title"></a></h2>
                            <p class="text-ellipsis"
                               style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;"
                               x-text="project.description"></p>
                        </div>

                        <!-- Нижняя часть -->
                        <div class="mt-auto position-relative">
                            <img :src="project.image" alt="" loading="lazy"
                                 class="w-100 object-cover" style="height: 300px; object-fit: cover; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">

                            <!-- Кнопка "Смотреть" -->
                            <div class="position-absolute bottom-4 start-3">
                                <a class="post_btn" :href="project.link">
                                    Смотреть <span class="arrow_bg"><i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                            </div>

                            <!-- Метаданные -->
                            <div class="meta_data position-absolute bottom-1 start-3 end-3 d-flex justify-content-between text-white px-3 small">
                                <a href="#" x-text="project.views + ' просмотров'"></a>
                                <a href="#" x-text="project.votes + ' голосов'"></a>
                            </div>
                        </div>

                    </div>
                </div>
            </template>
        </div>
    </div>
</main>

@can('create', App\Models\Project::class)
    <section class="my-5">
        <div class="container text-end">
            <button type="button" class="main_btn border-0" data-bs-toggle="modal" data-bs-target="#projectModal">
                <i class="fa-solid fa-plus me-2"></i> Опубликовать инициативу
            </button>
        </div>
    </section>
@endcan

<section class="my-5">
    <div class="container" x-data="sliderData('review')" x-init="true">
        <div class="d-flex justify-content-between mb-3">
            <h2 class="fw-bold">На рассмотрении</h2>
            <div class="d-flex justify-content-between align-items-center">
                <a class="slide_btn" href="#" @click.prevent="prev"><i class="fa-solid fa-caret-left"></i></a>
                <a class="slide_btn" href="#" @click.prevent="next"><i class="fa-solid fa-caret-right"></i></a>
            </div>
        </div>
        <div class="posts row">
            <template x-for="(project, index) in visibleItems()" :key="index">
                <div class="col-sm-12 col-lg-4 mb-3">
                    <div class="post bg-gray position-relative d-flex flex-column h-100">
                        <div class="p-4">
                            <div class="d-flex mb-3 flex-wrap gap-2">
                                <div class="tag" x-text="project.author"></div>
                                <div class="tag" x-text="project.group"></div>
                            </div>
                            <h2><a :href="project.link" x-text="project.title"></a></h2>
                            <p class="text-ellipsis mb-5" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;" x-text="project.description"></p>
                        </div>
                        <div class="mt-auto position-relative">
                            <a class="post_btn position-absolute" style="bottom: 10px; left: 1rem;" :href="project.link">
                                Смотреть <span class="arrow_bg"><i class="fa-solid fa-arrow-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

<section class="my-5">
    <div class="container" x-data="sliderData('accepted')" x-init="true">
        <div class="d-flex justify-content-between mb-3">
            <h2 class="fw-bold">Решение принято</h2>
            <div class="d-flex justify-content-between align-items-center">
                <a class="slide_btn" href="#" @click.prevent="prev"><i class="fa-solid fa-caret-left"></i></a>
                <a class="slide_btn" href="#" @click.prevent="next"><i class="fa-solid fa-caret-right"></i></a>
            </div>
        </div>
        <div class="posts row">
            <template x-for="(project, index) in visibleItems()" :key="index">
                <div class="col-sm-12 col-lg-4 mb-3">
                    <div class="post bg-salad position-relative d-flex flex-column h-100">
                        <div class="p-4">
                            <div class="d-flex mb-3 flex-wrap gap-2">
                                <div class="tag" x-text="project.author"></div>
                                <div class="tag" x-text="project.group"></div>
                            </div>
                            <h2><a :href="project.link" x-text="project.title"></a></h2>
                            <p class="text-ellipsis" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;" x-text="project.description"></p>
                        </div>
                        <div class="mt-auto position-relative">
                            <img :src="project.image" alt="" loading="lazy" class="w-100 object-cover"
                                 style="height: 300px; object-fit: cover; border-bottom-left-radius: 1rem; border-bottom-right-radius: 1rem;">
                            <div class="position-absolute bottom-4 start-3">
                                <a class="post_btn" :href="project.link">
                                    Смотреть <span class="arrow_bg"><i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                            </div>
                            <div class="meta_data position-absolute bottom-1 start-3 end-3 d-flex justify-content-between text-white px-3 small">
                                <a href="#" x-text="project.views + ' просмотров'"></a>
                                <a href="#" x-text="project.votes + ' голосов'"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

<section class="my-5">
    <div class="container" x-data="sliderData('news')" x-init="true">
        <h2 class="text-center fw-bold mb-4">Новости проекта</h2>
        <div class="row">
            <template x-for="(news, index) in visibleItems()" :key="index">
                <div class="col-sm-12 col-lg-3 mb-3">
                    <div class="news" :class="news.bgClass">
                        <div class="d-flex mb-3">
                            <template x-for="tag in news.tags">
                                <div class="tag fw-bold" x-text="tag"></div>
                            </template>
                        </div>
                        <h4 class="fw-bold" x-text="news.description"></h4>
                        <div class="d-flex justify-content-between">
                            <div class="date" x-text="news.date"></div>
                            <div><a :href="news.link" style="color: #000; text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a></div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form method="POST" action="{{ route('cabinet.projects.store') }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="projectModalLabel">Новая инициатива</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Название проекта</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание проекта</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="source_lists" class="form-label">Использованные источники</label>
                    <select name="source_lists[]" id="source_lists" class="selectpicker form-select" multiple data-live-search="true" data-style="form-control" data-actions-box="true"
                            title="Выберите источники">
                        @foreach($sources as $source)
                            <option value="{{ $source->id }}">{{ $source->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="new_sources[]" class="form-label">Новый источник (если нет в списке)</label>
                    <input type="text" name="new_sources[]" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="media[]" class="form-label">Прикрепить файлы (изображения, документы, видео)</label>
                    <input type="file" name="media[]" id="media" class="form-control" multiple>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

@include('includes.footer')

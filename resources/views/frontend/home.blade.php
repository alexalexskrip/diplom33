@include('includes.header')

<main>
    <div class="container" x-data="sliderData()" x-init="true">
        <p class="my-text-muted">Всего инициатив: {{ $formattedProjects->count() }}</p>

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

<script>
    window.__sliderData = { initiatives: @json($formattedProjects->values()->all()) };
</script>

<section class="my-5" id="">
    <div class="container">
        <div class="text-end">
            <a class="main_btn" href="#"><i class="fa-solid fa-plus"></i> Опубликовать инициативу</a>
        </div>
    </div>
</section>

<section class="my-5" id="in_watch">
    <div class="container">
        <h2 class="mb-3 fw-bold">На рассмотрении</h2>
        <div class="row align-items-center">
            <div class="col-sm-12 col-lg-4 mb-3">
                <div class="post bg-gray position-relative">
                    <div class="p-4"> <!-- p-4 - паддинг (внутр. отступ)-->
                        <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                            <div class="tag">Некрылова Анна</div>
                            <div class="tag">ДМБИ 301</div>
                        </div>
                        <h2>Спасаю Китов, и Кормлю кошек</h2>
                        <p class="mb-5">Описание проекта, Современные технологии достигли такого уровня развития, что нам не хватит и предло...</p>
                    </div>
                    <div>
                        <a class="post_btn" style="bottom: 10px;" href="">Смотреть <span class="arrow_bg"><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 mb-3">
                <div class="post bg-gray position-relative">
                    <div class="p-4"> <!-- p-4 - паддинг (внутр. отступ)-->
                        <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                            <div class="tag">Некрылова Анна</div>
                            <div class="tag">ДМБИ 301</div>
                        </div>
                        <h2>Спасаю Китов, и Кормлю кошек</h2>
                        <p class="mb-5">Описание проекта, Современные технологии достигли такого уровня развития, что нам не хватит и предло...</p>
                    </div>
                    <div>
                        <a class="post_btn" style="bottom: 10px;" href="">Смотреть <span class="arrow_bg"><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 mb-3">
                <div class="post bg-gray position-relative">
                    <div class="p-4"> <!-- p-4 - паддинг (внутр. отступ)-->
                        <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                            <div class="tag">Некрылова Анна</div>
                            <div class="tag">ДМБИ 301</div>
                        </div>
                        <h2>Спасаю Китов, и Кормлю кошек</h2>
                        <p class="mb-5">Описание проекта, Современные технологии достигли такого уровня развития, что нам не хватит и предло...</p>
                    </div>
                    <div>
                        <a class="post_btn" style="bottom: 10px;" href="">Смотреть <span class="arrow_bg"><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <h2 class="mb-3 fw-bold">Решение принято</h2>
        <div class="posts row">
            <div class="col-sm-12 col-lg-4 mb-3"> <!-- col-sm-12 на маленьком экране займёт всю шрину, на большом col-lg-4 - займёт 4 колонки -->
                <div class="post bg-salad position-relative">
                    <div class="p-4"> <!-- p-4 - паддинг (внутр. отступ)-->
                        <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                            <div class="tag">Некрылова Анна</div>
                            <div class="tag">ДМБИ 301</div>
                        </div>
                        <h2>Спасаю Китов, и Кормлю кошек</h2>
                        <p>Описание проекта, Современные технологии достигли такого уровня развития, что нам не хватит и предло...</p>
                    </div>
                    <div>
                        <a class="post_btn" href="">Смотреть <span class="arrow_bg"><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                    <div class="meta_data">
                        <a href="#">50 просмотров</a>
                        <a href="#">29 голосов</a>
                    </div>
                    <div class="">
                        <img src="{{ asset('images/post_1.jpeg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 mb-3">
                <div class="post bg-red position-relative">
                    <div class="p-4"> <!-- p-4 - паддинг (внутр. отступ)-->
                        <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                            <div class="tag">Запеканкин Стас</div>
                            <div class="tag">УДОФ 412</div>
                        </div>
                        <h2>Общественную парковку в массы!</h2>
                        <p>Описание проекта, Современные технологии достигли такого уровня развития, что нам не хватит и предло...</p>
                    </div>
                    <div>
                        <a class="post_btn" href="">Смотреть <span class="arrow_bg"><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                    <div class="meta_data">
                        <a href="#">50 просмотров</a>
                        <a href="#">29 голосов</a>
                    </div>
                    <div class="">
                        <img src="{{ asset('images/post_2.jpeg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 mb-3">
                <div class="post bg-red position-relative">
                    <div class="p-4"> <!-- p-4 - паддинг (внутр. отступ)-->
                        <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                            <div class="tag">Некрылова Анна</div>
                            <div class="tag">ДМБИ 301</div>
                        </div>
                        <h2>Спасаю Китов, и Кормлю кошек</h2>
                        <p>Описание проекта, Современные технологии достигли такого уровня развития, что нам не хватит и предло...</p>
                    </div>
                    <div>
                        <a class="post_btn" href="">Смотреть <span class="arrow_bg"><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                    <div class="meta_data">
                        <a href="#">50 просмотров</a>
                        <a href="#">29 голосов</a>
                    </div>
                    <div class="">
                        <img src="{{ asset('images/post_2.jpeg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">Новости проекта</h2>
        <div class="row">
            <div class="col-sm-12 col-lg-3 mb-3">
                <div class="news bg-salad">
                    <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                        <div class="tag fw-bold">#Учёба</div>
                        <div class="tag fw-bold">#Каникулы</div>
                    </div>
                    <h4 class="fw-bold">Начинаются каникулы, с 18 мая просьба..</h4>
                    <div class="d-flex justify-content-between">
                        <div class="date">10 мая 2025</div>
                        <div><a href="#" style="color: #000; text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3 mb-3">
                <div class="news bg-blue">
                    <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                        <div class="tag fw-bold">#Учёба</div>
                        <div class="tag fw-bold">#Каникулы</div>
                    </div>
                    <h4 class="fw-bold">Начинаются каникулы, с 18 мая просьба..</h4>
                    <div class="d-flex justify-content-between">
                        <div class="date">10 мая 2025</div>
                        <div><a href="#" style="color: #000; text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3 mb-3">
                <div class="news bg-yellow">
                    <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                        <div class="tag fw-bold">#Учёба</div>
                        <div class="tag fw-bold">#Каникулы</div>
                    </div>
                    <h4 class="fw-bold">Начинаются каникулы, с 18 мая просьба..</h4>
                    <div class="d-flex justify-content-between">
                        <div class="date">10 мая 2025</div>
                        <div><a href="#" style="color: #000; text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3 mb-3">
                <div class="news bg-red">
                    <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                        <div class="tag fw-bold">#Учёба</div>
                        <div class="tag fw-bold">#Каникулы</div>
                    </div>
                    <h4 class="fw-bold">Начинаются каникулы, с 18 мая просьба..</h4>
                    <div class="d-flex justify-content-between">
                        <div class="date">10 мая 2025</div>
                        <div><a href="#" style="color: #000; text-decoration: none;"><i class="fa-solid fa-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('includes.footer')

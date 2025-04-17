@include('includes.header')
  <header>
    <div class="top-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2">
                    <div class="logo">
                        <img src="{{ asset('public/images/imgpsh_fullsize_anim.png') }}" alt="">
                    </div>
                </div>
                <div class="col-10">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <div class="menu">
                                <ul>
                                    <li><a href="#">Как это работает?</a></li>
                                    <li><a href="#">Обратная связь</a></li>
                                    <li><a href="#">Вопрос-ответ</a></li>
                                    <li><a href="/profile.html">Кабинет</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text-center"><i class="fa-solid fa-phone"></i> 8 (800) 550 03 63</div>
                        </div>
                        <div class="col-2 text-end">
                            <a class="main_btn" href="#">Вход</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </header>

    <main>
        <div class="container">
            <p class="my-text-muted">Всего инициатив: 22804</p>

            <div class="d-flex justify-content-between mb-5">
                <h1>Инициативы на голосвании</h1>
                <div class="d-flex justify-content-between align-items-center">
                    <a class="slide_btn" href="#"><i class="fa-solid fa-caret-left"></i></a>
                    <a class="slide_btn" href="#"><i class="fa-solid fa-caret-right"></i></a>
                </div>
            </div>
            <div class="posts row">
                <div class="col-sm-12 col-lg-4 mb-3"> <!-- col-sm-12 на маленьком экране займёт всю шрину, на большом col-lg-4 - займёт 4 колонки -->
                    <div class="post bg-salad position-relative">
                        <div class="p-4"> <!-- p-4 - паддинг (внутр. отступ)-->
                            <div class="d-flex mb-3"> <!-- d-flex - display:flex mb-3 margin-bottom: 1.5rem -->
                                <div class="tag">Некрылова Анна</div>
                                <div class="tag">ДМБИ 301</div>
                            </div>
                            <h2><a href="/post_1.html">Спасаю Китов, и Кормлю кошек</a></h2>
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
                            <img src="{{ asset('public//images/post_1.jpeg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 mb-3">
                    <div class="post bg-blue position-relative">
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
                            <img src="{{ asset('public/images/post_2.jpeg') }}" alt="">
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
                            <img src="{{ asset('public/images/post_3.jpeg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
                            <img src="{{ asset('public/images/post_1.jpeg') }}" alt="">
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
                            <img src="{{ asset('public/images/post_2.jpeg') }}" alt="">
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
                            <img src="{{ asset('public/images/post_2.jpeg') }}" alt="">
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


   
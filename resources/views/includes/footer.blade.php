<footer>
        <div class="container">
            <div class="row align-items-center mb-3">
                <div class="col-sm-12 col-lg-2">
                    <div class="logo">
                        @if(request()->routeIs('frontend.home'))
                            <img src="{{ asset('images/logo_footer.png') }}" alt="">
                        @else
                            <a href="{{ route('frontend.home') }}" class="logo">
                                <img src="{{ asset('images/logo_footer.png') }}" alt="">
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="menu">
                        <ul>
                            <li><a href="{{ route('frontend.page.memo') }}">Памятка</a></li>
                            <li><a href="{{ route('frontend.page.about') }}">О проекте</a></li>
                            <li><a href="{{ route('frontend.page.news') }}">Новости</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-3 offset-md-1 justify-content-end text-end">
                    <div><a class="footer_link" href="#">Пользовательское соглашение</a></div>
                    <div>Сайт разработал: Скрипов А. О.</div>
                    {{--                    <div>По вопросам работы портала обращайтесь:</div>--}}
                    {{--                    <div><a style="text-decoration: none; color:#000" href="mailto:info@roi.ru">info@roi.ru</a></div>--}}
                    {{--                    <div class="footer_link">8-800-200-61-62</div>--}}
                    {{--                    <div>API РОИ</div>--}}
                </div>
                {{--                <div class="col-sm-12 col-lg-4 mb-3">--}}
                {{--                    <div class="footer_link">При поддержке</div>--}}
                {{--                    <div>Фонда информационной демократии</div>--}}
                {{--                </div>--}}
            </div>
{{--            <div class="row">--}}
{{--                --}}
{{--            </div>--}}
        </div>
    </footer>


<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>

<script>
    window.pluralizeRu = function(n, one, few, many) {
        n = Math.abs(n);
        if (n % 10 === 1 && n % 100 !== 11) return one;
        if (n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20)) return few;
        return many;
    };
</script>
</body>
</html>


<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Сайт студенческих инициатив</title>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @if(session()->has('success'))
            <div class="alert alert-success" role="alert" style="position: absolute; top: 120px; right: 30px; z-index: 100; max-width: 420px">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if(session()->has('wrong'))
            <div class="alert alert-danger" role="alert" style="position: absolute; top: 120px; right: 30px; z-index: 100; max-width: 420px">
                <p>{{ session('wrong') }}</p>
            </div>
        @endif

        <header>
            <div class="top-bar">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-2">
                            <div class="logo">
                                @if(request()->routeIs('frontend.home'))
                                    <img src="{{ asset('images/imgpsh_fullsize_anim.png') }}" alt="">
                                @else
                                    <a href="{{ route('frontend.home') }}">
                                        <img src="{{ asset('images/imgpsh_fullsize_anim.png') }}" alt="">
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="row align-items-center">
                                <div class="col-7">
                                    <div class="menu">
                                        <ul>
                                            <li><a href="#">Как это работает?</a></li>
                                            <li><a href="{{ route('frontend.feedback.form') }}">Обратная связь</a></li>
                                            <li><a href="#">Вопрос-ответ</a></li>
                                            {{--                                    <li><a href="{{ route('cabinet.dashboard') }}">Кабинет</a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="text-center"><i class="fa-solid fa-phone"></i> 8 (800) 550 03 63</div>
                                </div>
                                <div class="col-2 text-end">
                                    <a class="main_btn" href="{{ route('cabinet.dashboard') }}">
                                        {{ auth()->check() ? 'Кабинет' : 'Вход' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

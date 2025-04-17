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
            <div class="col-sm-12 col-lg-8 offset-sm-0 offset-lg-2">
                <table class="table">
                    <thead>
                        <tr>
                            <td>№</td>
                            <td>Название</td>
                            <td>Дата</td>                           
                            <td>Описание</td>
                            <td>Текст</td>
                            <td>Действие</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php $num = 1 @endphp
                  
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$num}}</td>
                                <td>{{$post->name}}</td>
                                <td>{{$post->date}}</td>
                                <td>{{$post->description}}</td>
                                <td>{{$post->text}}</td>
                                <td>
                                    <a href="">Удалить</a> <a href="">Редактировать</a>
                                </td>
                            </tr>
                            @php $num++ @endphp   
                        @endforeach
                    </tbody>

                </table>
                
               
            </div>
        </div>
    </main>
      
  
@include('includes.footer')


   
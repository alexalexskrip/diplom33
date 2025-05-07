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
                <h1>Инициативы на голосовании</h1>
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
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$post->name}}</td>
                                <td>{{$post->date}}</td>
                                <td>{{$post->description}}</td>
                                <td>{{$post->text}}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" onclick="return confirm('Вы уверены?')" class="btn btn-link p-0 m-0">
                                                Удалить
                                            </button>
                                        </form>
                                        <a href="">Редактировать</a>
                                    </div>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>

                </table>
                
               
            </div>
        </div>
    </main>
      
  
@include('includes.footer')


   
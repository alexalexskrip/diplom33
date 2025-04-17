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
            <div class="col-sm-12 col-lg-6 offset-sm-0 offset-lg-3">
                @if ($errors->any()) 
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                    //В случае возникновения ошибки появляется сообщение
                </div>
                @endif
                <form action="{{route('post.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Наименование статьи</label> 
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="date">Дата создания статьи</label> 
                        <input type="date" name="date" class="form-control" id="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="description">Описание</label> 
                        <textarea name="description" class="form-control" id="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="text">Текст статьи</label> 
                        <textarea name="text" class="form-control" id="text" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
      
  
@include('includes.footer')


   
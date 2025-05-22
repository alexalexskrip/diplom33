@include('includes.header')

<main>
    <div class="container my-5">
        <x-breadcrumbs :items="[
            ['title' => 'Главная', 'url' => route('frontend.home')],
            ['title' => 'Обратная связь']
        ]"/>

        <h1>Обратная связь</h1>

        <div class="mt-4">
            <form method="POST" action="{{ route('frontend.feedback.send') }}">
                @csrf

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Ваше имя</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Сообщение</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark d-flex align-items-center gap-2 px-4 py-2">
                    <span>Отправить</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</main>

@include('includes.footer')

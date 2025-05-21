@include('includes.header')

<main>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

{{--                @if(session('success'))--}}
{{--                    <div class="alert alert-success">{{ session('success') }}</div>--}}
{{--                @endif--}}

                <div class="card shadow rounded">
                    <div class="card-body p-4">

                        <h2 class="mb-4">Обратная связь</h2>

                        <form method="POST" action="{{ route('frontend.feedback.send') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Ваше имя</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Сообщение</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-dark d-flex align-items-center gap-2 px-4 py-2">
                                <span>Отправить</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@include('includes.footer')

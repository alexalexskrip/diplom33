@include('includes.header')

<main>
    <div class="container my-5">
        <x-breadcrumbs :items="[
            ['title' => 'Главная', 'url' => route('frontend.home')],
            ['title' => 'Памятка участникам']
        ]"/>

        <h1>Памятка участникам</h1>

        <div class="mt-4">
            <h2 class="mb-2">Что нужно знать:</h2>
            <ul class="list-unstyled lh-lg">
                <li>— Как подать инициативу</li>
                <li>— Какие этапы проходит инициатива</li>
                <li>— Как происходит голосование</li>
                <li>— Кто рассматривает инициативы</li>
                <li>— Что означает статус инициативы</li>
            </ul>
        </div>

        <div class="mt-4">
            <h2 class="mb-2">Контакты организаторов:</h2>
            <p class="mb-0">Email: <a href="mailto:info@project.local">info@project.local</a></p>
            <p>Телефон: +7 (123) 456-78-90</p>
        </div>

        <div class="mt-4">
            <a href="{{ route('frontend.page.about') }}" class="btn btn-outline-primary">
                Подробнее о проекте
            </a>
        </div>
    </div>
</main>

@include('includes.footer')

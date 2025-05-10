<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Создание новости</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @include('cabinet.projectnews._form', [
                    'method' => 'POST',
                    'action' => route('cabinet.projectnews.store'),
                    'news' => new \App\Models\ProjectNews,
                    'projects' => $projects
                ])
            </div>
        </div>
    </div>
</x-app-layout>

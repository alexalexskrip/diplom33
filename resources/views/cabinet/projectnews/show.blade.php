<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Просмотр новости</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">{{ $projectnews->name_projectnews }}</h1>

                    <p class="mb-4"><strong>Проект:</strong> {{ $projectnews->project->name_project ?? '—' }}</p>
                    <p class="mb-4"><strong>Дата:</strong> {{ $projectnews->date_projectnews->format('d.m.Y') }}</p>
                    <p class="mb-4"><strong>Название:</strong> {{ $projectnews->name_projectnews }}</p>
                    <p class="mb-4"><strong>Описание:</strong> {{ $projectnews->discription_projectnews }}</p>

                    <div class="mt-10">
                        <x-primary-button href="{{ route('cabinet.projectnews.edit', $projectnews->id) }}">Редактировать</x-primary-button>
                        <a href="{{ route('cabinet.projectnews.index') }}" class="text-blue-500 hover:underline ml-4">← Назад к списку</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

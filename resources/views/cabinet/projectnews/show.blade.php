<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Просмотр новости</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">{{ $projectnews->name }}</h1>

                    <p class="mb-4"><strong>Проект:</strong> {{ $projectnews->project->name ?? '—' }}</p>
                    <p class="mb-4"><strong>Дата:</strong> {{ $projectnews->created_at->format('d.m.Y') }}</p>
                    <p class="mb-4"><strong>Название:</strong> {{ $projectnews->name }}</p>
                    <p class="mb-4"><strong>Описание:</strong> {{ $projectnews->description }}</p>

                    <div class="mt-10">
                        <x-primary-button href="{{ route('cabinet.projectnews.edit', $projectnews->id) }}">Редактировать</x-primary-button>
                        <a href="{{ route('cabinet.projectnews.index') }}" class="text-blue-500 hover:underline ml-4">← Назад к списку</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cabinet-layout>

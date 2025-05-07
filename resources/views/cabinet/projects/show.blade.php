<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Просмотр проекта</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="text-2xl font-bold mb-4">{{ $project->name_project }}</h1>

                    <div class="mb-4">
                        <span class="font-semibold">Статус:</span>
                        {{ $project->status->namesource_net ?? '—' }}
                    </div>

                    <div class="mb-6">
                        <span class="font-semibold">Описание:</span>
                        <p class="mt-1 text-gray-700">{{ $project->discription_project }}</p>
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('cabinet.projects.edit', $project->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Редактировать</a>
                        <a href="{{ route('cabinet.projects.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Назад</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

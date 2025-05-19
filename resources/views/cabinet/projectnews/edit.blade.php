<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Редактирование новости</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @include('cabinet.projectnews._form', [
                    'method' => 'PUT',
                    'action' => route('cabinet.projectnews.update', $projectnews),
                    'news' => $projectnews,
                    'projects' => $projects
                ])
            </div>
        </div>
    </div>
</x-cabinet-layout>

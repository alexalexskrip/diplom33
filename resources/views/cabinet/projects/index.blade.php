<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Проекты</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-medium mb-6">Список проектов</h1>

                    <x-flash-message/>

                    @can('create', App\Models\Project::class)
                        <a href="{{ route('cabinet.projects.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded mb-4 inline-block">
                            Добавить проект
                        </a>
                    @endcan

                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left">Название</th>
                                <th class="py-3 px-4 text-left">Статус</th>
                                <th class="py-3 px-4 text-left">Описание</th>
                                <th class="py-3 px-4 text-left">Изображение</th>
                                <th class="py-3 px-4 text-left">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($projects as $project)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $project->name }}</td>
                                    <td class="py-3 px-4">{{ $project->status->name ?? '—' }}</td>
                                    <td class="py-3 px-4">{{ Str::limit($project->description) }}</td>
                                    <td class="py-3 px-4">

                                        @php
                                            $firstImage = $project->getMedia('images')->sortBy('custom_properties.position')->first();
                                        @endphp

                                        @if($firstImage)
                                            <img src="{{ $firstImage->getUrl() }}" alt="" class="w-16 h-16 object-cover rounded">
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex space-x-2 align-content-center align-middle items-center">
                                            <a href="{{ route('cabinet.projects.show', $project->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Смотреть</a>
                                            @can('update', $project)
                                                <a href="{{ route('cabinet.projects.edit', $project->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Изменить</a>
                                            @endcan
                                            @can('delete', $project)
                                                <form action="{{ route('cabinet.projects.destroy', $project->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Удалить проект?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Удалить</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3 text-gray-500">Проекты не найдены</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($projects->hasPages())
                        <div class="mt-4">{{ $projects->links() }}</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-cabinet-layout>

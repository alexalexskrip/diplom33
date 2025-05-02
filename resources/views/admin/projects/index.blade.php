<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Проекты</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Список проектов</h1>

                    <x-flash-message />

                    <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Добавить проект
                    </a>

                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left">Название</th>
                                <th class="py-3 px-4 text-left">Статус</th>
                                <th class="py-3 px-4 text-left">Описание</th>
                                <th class="py-3 px-4 text-left">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($projects as $project)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $project->name_project }}</td>
                                    <td class="py-3 px-4">{{ $project->status->namesource_net ?? '—' }}</td>
                                    <td class="py-3 px-4">{{ Str::limit($project->discription_project, 100) }}</td>
                                    <td class="py-3 px-4 flex space-x-2">
                                        <a href="{{ route('projects.show', $project->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Смотреть</a>
                                        <a href="{{ route('projects.edit', $project->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Изменить</a>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Удалить проект?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-3 text-gray-500">Проекты не найдены</td></tr>
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
</x-app-layout>

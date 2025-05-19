<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Новости проекта</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Список новостей</h1>

                    <x-flash-message/>

                    @can('create', App\Models\ProjectNews::class)
                        <a href="{{ route('cabinet.projectnews.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                            Добавить новость
                        </a>
                    @endcan

                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left">Название</th>
                                <th class="py-3 px-4 text-left">Проект</th>
                                <th class="py-3 px-4 text-left">Дата</th>
                                <th class="py-3 px-4 text-left">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($projectNews as $news)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ Str::limit($news->name) }}</td>
                                    <td class="py-3 px-4">{{ $news->project->name ?? '—' }}</td>
                                    <td class="py-3 px-4">{{ $news->created_at->format('d.m.Y') }}</td>
                                    <td class="py-3 px-4">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('cabinet.projectnews.show', $news->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Смотреть</a>
                                            @can('update', $news)
                                                <a href="{{ route('cabinet.projectnews.edit', $news->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Изменить</a>
                                            @endcan
                                            @can('delete', $news)
                                                <form action="{{ route('cabinet.projectnews.destroy', $news->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Удалить новость?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Удалить</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-gray-500">Новости не найдены</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($projectNews->hasPages())
                        <div class="mt-4">{{ $projectNews->links() }}</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-cabinet-layout>

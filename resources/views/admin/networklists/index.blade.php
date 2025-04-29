<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Сети</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Список сетей</h1>

                    <x-flash-message />

                    <a href="{{ route('networklists.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Добавить сеть
                    </a>

                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left">Название</th>
                                <th class="py-3 px-4 text-left">Сайт</th>
                                <th class="py-3 px-4 text-left">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($networklists as $networklist)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $networklist->name_networkList }}</td>
                                    <td class="py-3 px-4 text-blue-500 underline">
                                        <a href="{{ $networklist->site_netWWorklist }}" target="_blank">{{ $networklist->site_netWWorklist }}</a>
                                    </td>
                                    <td class="py-3 px-4 flex space-x-2">
                                        <a href="{{ route('networklists.edit', $networklist->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Изменить</a>
                                        <form action="{{ route('networklists.destroy', $networklist->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Удалить сеть?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="text-center py-3 text-gray-500">Сети не найдены</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($networklists->hasPages())
                        <div class="mt-4">{{ $networklists->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

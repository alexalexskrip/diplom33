<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Студенты</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-medium mb-6">Список студентов</h1>

                    <x-flash-message/>

                    @can('create', App\Models\User::class)
                        <a href="{{ route('cabinet.students.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded mb-4 inline-block">
                            Добавить студента
                        </a>
                    @endcan

                    <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left">ФИО</th>
                                <th class="py-3 px-4 text-left">Email</th>
                                <th class="py-3 px-4 text-left">Группа</th>
                                <th class="py-3 px-4 text-left">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $user->fullname }}</td>
                                    <td class="py-3 px-4">{{ $user->email }}</td>
                                    <td class="py-3 px-4">{{ Str::limit($user->group->name, 50) ?? '—' }}</td>
                                    <td class="py-3 px-4">
                                        <div class="flex space-x-2 items-center">
                                            @can('update', $user)
                                                <a href="{{ route('cabinet.students.edit', $user->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Изменить</a>
                                            @endcan
                                            @can('delete', $user)
                                                <form action="{{ route('cabinet.students.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Удалить студента?')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Удалить</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-gray-500">Студенты не найдены</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($users->hasPages())
                        <div class="mt-4">{{ $users->links() }}</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-cabinet-layout>

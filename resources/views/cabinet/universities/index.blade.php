<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Университеты') }}
        </h2>
    </x-slot>

    <section class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">Список университетов</h1>

                    <x-flash-message/>

                    <a href="{{ route('cabinet.universities.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block mb-10">
                        Добавить университет
                    </a>

                    <div class="container mx-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-3 px-4 text-left">Название</th>
                                    <th class="py-3 px-4 text-left">Адрес</th>
                                    <th class="py-3 px-4 text-left">Телефон</th>
                                    <th class="py-3 px-4 text-left">Email</th>
                                    <th class="py-3 px-4 text-left">Действия</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse($universities as $university)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4">{{ $university->name_university }}</td>
                                        <td class="py-3 px-4 text-gray-400">{{ $university->address_university }}</td>
                                        <td class="py-3 px-4 text-gray-400">{{ $university->phone_university }}</td>
                                        <td class="py-3 px-4 text-gray-400">{{ $university->mail_university }}</td>
                                        <td class="py-3 px-4 flex space-x-2">
                                            <a href="{{ route('cabinet.universities.edit', $university->id) }}"
                                               class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Изменить
                                            </a>
                                            <form action="{{ route('cabinet.universities.destroy', $university->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                                                        onclick="return confirm('Удалить университет?')">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Удалить
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Университеты не найдены</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($universities->hasPages())
                        <div class="mt-4">
                            {{ $universities->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

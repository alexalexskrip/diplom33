<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Добавить источник</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('sourcelists.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label for="name_sourcelist" class="block text-sm font-medium text-gray-700">Название</label>
                            <input type="text" name="name_sourcelist" id="name_sourcelist" value="{{ old('name_sourcelist') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('name_sourcelist') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Сохранить</button>
                            <a href="{{ route('sourcelists.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

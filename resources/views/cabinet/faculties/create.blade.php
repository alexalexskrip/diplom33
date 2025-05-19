<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Факультеты') }}
        </h2>
    </x-slot>

    <section class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-6">Создание факультета</h3>

                    <form action="{{ route('cabinet.faculties.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-900">Название</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="university_id" class="block text-sm font-semibold text-gray-900">Университет</label>
                                <select name="university_id" id="university_id" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">-- выберите университет --</option>
                                    @foreach($universities as $university)
                                        <option value="{{ $university->id }}" @selected(old('university_id') == $university->id)>{{ $university->name }}</option>
                                    @endforeach
                                </select>
                                @error('university_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 mt-10">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Сохранить</button>
                            <a href="{{ route('cabinet.faculties.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-cabinet-layout>

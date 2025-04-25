<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Курсы') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-6">Создание курса</h3>

                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf

                        <div x-data="{
                            university: '',
                            faculties: @js($faculties),
                            get filteredFaculties() {
                                return this.faculties.filter(f => f.id_university == this.university);
                            }
                        }">

                            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                                <!-- Университет -->
                                <div>
                                    <label for="university" class="block text-sm font-semibold text-gray-900">Университет</label>
                                    <select name="id_university" id="university" x-model="university"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="">-- выберите университет --</option>
                                        @foreach($universities as $university)
                                            <option value="{{ $university->id }}">{{ $university->name_university }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_university')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <!-- Факультет -->
                                <div>
                                    <label for="faculty" class="block text-sm font-semibold text-gray-900">Факультет</label>
                                    <select name="id_faculty" id="faculty"
                                            class="mt-2 block w-full rounded-md border-gray-300 shadow-sm"
                                            :disabled="!university">
                                        <template x-for="faculty in filteredFaculties" :key="faculty.id">
                                            <option :value="faculty.id" x-text="faculty.name_faculty"></option>
                                        </template>
                                    </select>
                                    @error('id_faculty')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>

                                <!-- Название курса -->
                                <div>
                                    <label for="name_course" class="block text-sm font-semibold text-gray-900">Название курса</label>
                                    <input type="text" name="name_course" id="name_course" value="{{ old('name_course') }}"
                                           class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                    @error('name_course')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 mt-10">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Сохранить</button>
                                <a href="{{ route('courses.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Отмена</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

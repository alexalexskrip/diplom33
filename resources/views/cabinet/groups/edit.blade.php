<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Группы') }}</h2>
    </x-slot>

    <section class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-6">Редактирование группы</h3>

                    <form action="{{ route('cabinet.groups.update', $group->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div x-data="{
                            university: '{{ old('university_id', $group->course->faculty->university_id) }}',
                            faculty: '{{ old('faculty_id', $group->course->faculty_id) }}',
                            faculties: @js($faculties),
                            courses: @js($courses),
                            get filteredFaculties() {
                                return this.faculties.filter(f => f.university_id == this.university);
                            },
                            get filteredCourses() {
                                return this.courses.filter(c => c.faculty_id == this.faculty);
                            }
                        }">

                            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                                <!-- Университет -->
                                <div>
                                    <label for="university_id" class="block text-sm font-semibold text-gray-900">Университет</label>
                                    <select id="university_id" x-model="university" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="">-- выберите университет --</option>
                                        @foreach($universities as $university)
                                            <option value="{{ $university->id }}" @selected(old('university_id', $group->course->faculty->university_id) == $university->id)>{{ $university->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('university_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Факультет -->
                                <div>
                                    <label for="faculty_id" class="block text-sm font-semibold text-gray-900">Факультет</label>
                                    <select id="faculty_id" x-model="faculty" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm" :disabled="!university">
                                        <option value="">-- выберите факультет --</option>
                                        <template x-for="f in filteredFaculties" :key="f.id">
                                            <option :value="f.id" x-text="f.name" :selected="f.id == {{ old('faculty_id', $group->course->faculty_id) }}"></option>
                                        </template>
                                    </select>
                                    @error('faculty_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Курс -->
                                <div>
                                    <label for="course_id" class="block text-sm font-semibold text-gray-900">Курс</label>
                                    <select name="course_id" id="course_id" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm" :disabled="!faculty">
                                        <option value="">-- выберите курс --</option>
                                        <template x-for="c in filteredCourses" :key="c.id">
                                            <option :value="c.id" x-text="c.name" :selected="c.id == {{ old('course_id', $group->course_id) }}"></option>
                                        </template>
                                    </select>
                                    @error('course_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <!-- Название группы -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-900">Название группы</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $group->name) }}" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm">
                                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 mt-10">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Обновить</button>
                                <a href="{{ route('cabinet.groups.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Отмена</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-cabinet-layout>

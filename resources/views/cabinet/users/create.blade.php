<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавить студента') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="userForm()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h1 class="text-2xl font-medium mb-6">Добавление студента</h1>

                <x-flash-message/>

                <form action="{{ route('cabinet.students.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="lastname" class="block text-sm font-medium text-gray-700">Фамилия</label>
                            <input type="text" id="lastname" name="lastname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label for="firstname" class="block text-sm font-medium text-gray-700">Имя</label>
                            <input type="text" id="firstname" name="firstname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label for="patronymic" class="block text-sm font-medium text-gray-700">Отчество</label>
                            <input type="text" id="patronymic" name="patronymic" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
                            <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Подтверждение пароля</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Университет / Факультет / Курс / Группа</label>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-2">
                            <select x-model="selectedUniversity" class="border rounded p-2">
                                <option value="">Выберите университет</option>
                                @foreach($universities as $university)
                                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                                @endforeach
                            </select>

                            <select x-model="selectedFaculty" class="border rounded p-2">
                                <option value="">Выберите факультет</option>
                                <template x-for="faculty in filteredFaculties()" :key="faculty.id">
                                    <option :value="faculty.id" x-text="faculty.name"></option>
                                </template>
                            </select>

                            <select x-model="selectedCourse" class="border rounded p-2">
                                <option value="">Выберите курс</option>
                                <template x-for="course in filteredCourses()" :key="course.id">
                                    <option :value="course.id" x-text="course.name"></option>
                                </template>
                            </select>

                            <select name="id_group" class="border rounded p-2">
                                <option value="">Выберите группу</option>
                                <template x-for="group in filteredGroups()" :key="group.id">
                                    <option :value="group.id" x-text="group.name"></option>
                                </template>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Социальные сети</label>
                        <template x-for="(net, index) in networks" :key="index">
                            <div class="grid grid-cols-5 gap-2 mt-2">
                                <select :name="`networks[${index}][network_id]`" class="col-span-2 border p-2 rounded">
                                    <template x-for="item in networklists" :key="item.id">
                                        <option :value="item.id" x-text="item.name"></option>
                                    </template>
                                </select>
                                <input type="text" :name="`networks[${index}][url]`" class="col-span-2 border p-2 rounded" placeholder="URL профиля">
                                <button type="button" class="text-red-500" @click="removeNetwork(index)">&times;</button>
                            </div>
                        </template>
                        <button type="button" class="text-blue-600 hover:underline mt-2" @click="addNetwork()">+ Добавить</button>
                    </div>

                    <div class="mt-6">
                        <x-primary-button>Сохранить</x-primary-button>
                        <a href="{{ route('cabinet.students.index') }}" class="ml-4 text-gray-600 hover:underline">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function userForm() {
            return {
                selectedUniversity: '',
                selectedFaculty: '',
                selectedCourse: '',
                faculties: @json($faculties),
                courses: @json($courses),
                groups: @json($groups),
                networklists: @json($networks),
                networks: [],
                filteredFaculties() {
                    return this.faculties.filter(f => f.university_id == this.selectedUniversity);
                },
                filteredCourses() {
                    return this.courses.filter(c => c.faculty_id == this.selectedFaculty);
                },
                filteredGroups() {
                    return this.groups.filter(g => g.course_id == this.selectedCourse);
                },
                addNetwork() {
                    this.networks.push({ network_id: '', url: '' });
                },
                removeNetwork(index) {
                    this.networks.splice(index, 1);
                }
            }
        }
    </script>
</x-cabinet-layout>

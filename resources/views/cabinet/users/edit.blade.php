<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редактировать студента') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="userForm()" x-init="init()">
        <div x-effect="filteredFaculties(); filteredCourses(); filteredGroups()"></div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h1 class="text-2xl font-medium mb-6">Редактирование студента</h1>

                <x-flash-message/>

                <form action="{{ route('cabinet.students.update', ['student' => $student->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="lastname" class="block text-sm font-medium text-gray-700">Фамилия</label>
                            <input type="text" id="lastname" name="lastname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('lastname', $student->lastname) }}" required>
                        </div>
                        <div>
                            <label for="firstname" class="block text-sm font-medium text-gray-700">Имя</label>
                            <input type="text" id="firstname" name="firstname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('firstname', $student->firstname) }}" required>
                        </div>
                        <div>
                            <label for="patronymic" class="block text-sm font-medium text-gray-700">Отчество</label>
                            <input type="text" id="patronymic" name="patronymic" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('patronymic', $student->patronymic) }}">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('email', $student->email) }}" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Университет / Факультет / Курс / Группа</label>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-2">
                            <div x-effect="updateOptions()" class="hidden"></div>
                            <select x-model="selectedUniversity" @change="manualChange = true" class="border rounded p-2">
                                <option value="">Выберите университет</option>
                                @foreach($universities as $university)
                                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                                @endforeach
                            </select>
                            <select x-model="selectedFaculty" @change="manualChange = true" x-html="facultyOptions" class="border rounded p-2">
                                <option value="">Выберите факультет</option>
                            </select>
                            <select x-model="selectedCourse" @change="manualChange = true" x-html="courseOptions" class="border rounded p-2">
                                <option value="">Выберите курс</option>
                            </select>
                            <select name="group_id" x-model="groupId" x-html="groupOptions" class="border rounded p-2">
                                <option value="">Выберите группу</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Социальные сети</label>
                        <template x-for="(net, index) in networks" :key="index">
                            <div class="grid grid-cols-5 gap-2 mt-2 items-center">
                                <select :name="`networks[${index}][network_id]`" class="col-span-2 border p-2 rounded">
                                    <template x-for="item in networklists" :key="item.id">
                                        <option :value="item.id" x-text="item.name" :selected="item.id == net.network_id"></option>
                                    </template>
                                </select>
                                <input type="text" :name="`networks[${index}][url]`" class="col-span-2 border p-2 rounded" placeholder="URL профиля" x-model="net.url">
                                <button
                                    type="button"
                                    class="text-red-600 hover:text-white hover:bg-red-600 border border-red-600 px-2 py-1 text-xs font-semibold rounded transition"
                                    @click="confirmRemove(index)"
                                >
                                    🗑 Удалить
                                </button>
                            </div>
                        </template>
                        <button type="button" class="text-blue-600 hover:underline mt-2" @click="addNetwork()">+ Добавить</button>
                    </div>

                    <div class="mt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Новый пароль</label>
                                <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Подтверждение пароля</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>
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
                get facultiesWatch() { this.updateOptions(); return this.selectedUniversity },
                get coursesWatch() { this.updateOptions(); return this.selectedFaculty },
                get groupsWatch() { this.updateOptions(); return this.selectedCourse },
                selectedUniversity: '',
                manualChange: false,
                selectedUniversityOld: '',
                selectedFaculty: '',
                selectedFacultyOld: '',
                selectedCourse: '',
                selectedCourseOld: '',
                groupId: '',
                faculties: @json($faculties),
                courses: @json($courses),
                groups: @json($groups),
                networks: @json($student->networks->map(fn($net) => ['network_id' => $net->id, 'url' => $net->pivot->url])),
                networklists: @json($networks),
                facultyOptions: '',
                courseOptions: '',
                groupOptions: '',
                init() {
                    this.selectedUniversity = '{{ old('university_id', $student->group?->course?->faculty->university_id ?? '') }}';
                    this.selectedFaculty = '{{ old('faculty_id', $student->group?->course->faculty_id ?? '') }}';
                    this.selectedCourse = '{{ old('course_id', $student->group?->course_id ?? '') }}';
                    this.groupId = '{{ old('group_id', $student->group_id ?? '') }}';
                    this.$nextTick(() => {
                        this.manualChange = false;
                    });
                },
                filteredFaculties() {
                    return this.faculties.filter(f => f.university_id == this.selectedUniversity);
                },
                filteredCourses() {
                    return this.courses.filter(c => c.faculty_id == this.selectedFaculty);
                },
                filteredGroups() {
                    return this.groups.filter(g => g.course_id == this.selectedCourse);
                },
                updateOptions() {
                    if (this.manualChange && this.selectedUniversity !== this.selectedUniversityOld) {
                        this.selectedFaculty = '';
                    }
                    if (this.manualChange && this.selectedFaculty !== this.selectedFacultyOld) {
                        this.selectedCourse = '';
                    }
                    if (this.manualChange && this.selectedCourse !== this.selectedCourseOld) {
                        this.groupId = '';
                    }
                    this.facultyOptions = this.filteredFaculties().map(f =>
                        `<option value="${f.id}" ${f.id == this.selectedFaculty ? 'selected' : ''}>${f.name}</option>`
                    ).join('');
                    this.courseOptions = this.filteredCourses().map(c =>
                        `<option value="${c.id}" ${c.id == this.selectedCourse ? 'selected' : ''}>${c.name}</option>`
                    ).join('');
                    this.groupOptions = this.filteredGroups().map(g =>
                        `<option value="${g.id}" ${g.id == this.groupId ? 'selected' : ''}>${g.name}</option>`
                    ).join('');
                    this.selectedUniversityOld = this.selectedUniversity;
                    this.selectedFacultyOld = this.selectedFaculty;
                    this.selectedCourseOld = this.selectedCourse;
                },
                addNetwork() {
                    this.networks.push({ network_id: '', url: '' });
                },
                confirmRemove(index) {
                    if (confirm('Вы уверены, что хотите удалить эту социальную сеть?')) {
                        this.removeNetwork(index);
                    }
                },
                removeNetwork(index) {
                    this.networks.splice(index, 1);
                },
            }
        }
    </script>
</x-cabinet-layout>

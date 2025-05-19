<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Редактирование проекта</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('cabinet.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name_project" class="block text-gray-700 font-medium">Название <span class="text-red-500">*</span></label>
                            <input type="text" id="name_project" name="name_project" class="mt-1 block w-full" value="{{ old('name_project', $project->name_project) }}" required>
                            @error('name_project')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="discription_project" class="block text-gray-700 font-medium">Описание <span class="text-red-500">*</span></label>
                            <textarea id="discription_project" name="discription_project" class="mt-1 block w-full" required>{{ old('discription_project', $project->discription_project) }}</textarea>
                            @error('discription_project')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="id_status" class="block text-gray-700 font-medium">Статус</label>
                            <select name="id_status" id="id_status" class="mt-1 block w-full">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" @selected(old('id_status', $project->id_status) == $status->id)>
                                        {{ $status->namesource_net }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_status')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4" x-data="{
                            selected: @js(old('source_lists', $project->sourceLists->pluck('id'))),
                            search: '',
                            all: @js($sourceLists),
                            toggle(id) {
                                const i = this.selected.indexOf(id);
                                i === -1 ? this.selected.push(id) : this.selected.splice(i, 1);
                            },
                            filtered() {
                                if (!this.search) return this.all;
                                return this.all.filter(s => s.name_sourcelist.toLowerCase().includes(this.search.toLowerCase()));
                            },
                            newSource: '',
                            newSources: [],
                            addNewSource() {
                                const name = this.newSource.trim();
                                if (name && !this.newSources.includes(name)) {
                                    this.newSources.push(name);
                                    this.newSource = '';
                                }
                            },
                            removeNewSource(name) {
                                this.newSources = this.newSources.filter(n => n !== name);
                            }
                        }">
                            <label class="block text-gray-700 mb-1 font-medium">Использованные источники</label>
                            <input type="text" x-model="search" placeholder="Поиск..." class="mb-2 block w-full border px-3 py-1 rounded">

                            <div class="grid gap-2 max-h-64 overflow-y-auto">
                                <template x-for="source in filtered()" :key="source.id">
                                    <div class="flex items-center space-x-2">
                                        <button type="button"
                                                @click="toggle(source.id)"
                                                :class="selected.includes(source.id) ? 'bg-blue-100 text-blue-700' : 'bg-gray-100'"
                                                class="px-3 py-1 rounded w-full text-left"
                                                x-text="source.name_sourcelist">
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <template x-for="id in selected" :key="'selected-'+id">
                                <input type="hidden" name="source_lists[]" :value="id">
                            </template>

                            <div class="mt-6">
                                <label for="new_source" class="block text-gray-700 mb-1 font-medium">Новые источники</label>
                                <div class="flex gap-2">
                                    <input type="text" id="new_source" x-model="newSource" class="block w-full border px-3 py-1 rounded">
                                    <button type="button" @click="addNewSource" class="bg-green-500 text-white px-4 py-1 rounded">Добавить</button>
                                </div>
                            </div>

                            <div class="mt-2">
                                <template x-for="(name, index) in newSources" :key="'new-'+index">
                                    <div class="flex items-center justify-between bg-gray-100 rounded px-3 py-1 mb-1">
                                        <span x-text="name"></span>
                                        <button type="button" @click="removeNewSource(name)" class="text-red-500 text-sm">Удалить</button>
                                        <input type="hidden" name="new_sources[]" :value="name">
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="media_files" class="block text-gray-700 mb-2 font-medium">Добавить изображения</label>
                            <input type="file" id="media_files" name="media_files[]" multiple>
                            @error('media_files.*')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                        </div>

                        <div class="mt-10 flex items-center">
                            <x-primary-button>Обновить</x-primary-button>
                            <a href="{{ route('cabinet.projects.index') }}" class="ml-4 text-blue-500 hover:underline">← Назад к списку</a>
                        </div>
                    </form>

                    @if ($project->medias->count())
                        <div class="mt-10">
                            <label class="block text-gray-700 mb-2 font-medium">Изображения проекта</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach ($project->medias as $media)
                                    <div class="relative border rounded overflow-hidden" x-data="{ confirm: false }">
                                        <button
                                            type="button"
                                            @click="confirm = true"
                                            class="absolute top-1 right-1 bg-red-600 text-white px-2 py-1 text-xs rounded z-10"
                                            title="Удалить изображение">
                                            ✕
                                        </button>

                                        <div x-show="confirm" class="absolute inset-0 bg-white/80 flex items-center justify-center z-20" x-transition>
                                            <div class="bg-white p-4 rounded shadow text-center space-y-4">
                                                <p>Удалить изображение?</p>
                                                <div class="flex justify-center gap-2">
                                                    <button @click="document.getElementById('delete-media-{{ $media->id }}').submit()" class="bg-red-600 text-white px-3 py-1 rounded">Да</button>
                                                    <button @click="confirm = false" class="bg-gray-300 px-3 py-1 rounded">Нет</button>
                                                </div>
                                            </div>
                                        </div>

                                        <img src="{{ asset('storage/projectmedia/' . $media->File_ProjectMedia) }}" class="object-cover w-full h-48 rounded" alt="">
                                    </div>
                                @endforeach
                            </div>

                            @foreach ($project->medias as $media)
                                <form id="delete-media-{{ $media->id }}" action="{{ route('cabinet.project-media.destroy', $media) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-cabinet-layout>

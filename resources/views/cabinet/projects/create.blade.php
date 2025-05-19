<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Добавление проекта</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('cabinet.projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium">Название проекта</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full" value="{{ old('name') }}">
                            @error('name')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-medium">Описание проекта</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full">{{ old('description') }}</textarea>
                            @error('description')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="status_id" class="block text-gray-700 font-medium">Статус</label>
                            <select name="status_id" id="status_id" class="mt-1 block w-full">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" @selected(old('status_id') == $status->id)>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4" x-data="{
                            selected: @js(old('source_lists', [])),
                            search: '',
                            all: @js($sources),
                            toggle(id) {
                                const i = this.selected.indexOf(id);
                                i === -1 ? this.selected.push(id) : this.selected.splice(i, 1);
                            },
                            filtered() {
                                if (!this.search) return this.all;
                                return this.all.filter(s => s.name.toLowerCase().includes(this.search.toLowerCase()));
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
                                                x-text="source.name">
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <template x-for="id in selected" :key="'selected-'+id">
                                <input type="hidden" name="source_lists[]" :value="id">
                            </template>

                            <div class="mt-6">
                                <label for="new_source" class="block text-gray-700 mb-1 font-medium">Новый источник (если нет в списке)</label>
                                <div class="flex gap-2">
                                    <input type="text" id="new_source" x-model="newSource" class="block w-full border px-3 py-1 rounded">
                                    <button type="button" @click="addNewSource" class="bg-green-500 text-white px-4 py-1 rounded">Добавить</button>
                                </div>
                                @error('new_sources')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
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
                            <x-primary-button>Сохранить</x-primary-button>
                            <a href="{{ route('cabinet.projects.index') }}" class="ml-4 text-blue-500 hover:underline">← Назад к списку</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-cabinet-layout>

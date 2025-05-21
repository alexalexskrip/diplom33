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
                            <label for="name" class="block text-gray-700 font-medium">Название <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full" value="{{ old('name', $project->name) }}" required>
                            @error('name')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-medium">Описание <span class="text-red-500">*</span></label>
                            <textarea id="description" name="description" class="mt-1 block w-full" required>{{ old('description', $project->description) }}</textarea>
                            @error('description')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="status_id" class="block text-gray-700 font-medium">Статус</label>
                            <select name="status_id" id="status_id" class="mt-1 block w-full">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" @selected(old('status_id', $project->status_id) == $status->id)>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4" x-data="{
                            selected: @js(old('source_lists', $project->sources->pluck('id'))),
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
                            <label class="block text-gray-700 mb-1 font-medium">Источники</label>
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
                            <label for="media" class="block text-gray-700 font-medium mb-2">Добавить файлы</label>
                            <input type="file" name="media[]" multiple>
                            @error('media.*')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>@enderror
                        </div>

                        <x-primary-button>Сохранить</x-primary-button>
                    </form>

                    @include('cabinet.projects.partials.project-users-form', ['project' => $project ?? null, 'allUsers' => $allUsers])

                    {{-- Изображения --}}
                    @if ($project->getMedia('images')->count())
                        <div class="mt-10">
                            <label class="block text-gray-700 mb-2 font-medium">Изображения:</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach ($project->getMedia('images') as $media)
                                    <div class="relative border rounded overflow-hidden" x-data="{ confirm: false }">
                                        <button type="button" @click="confirm = true" class="absolute top-1 right-1 bg-red-600 text-white px-2 py-1 text-xs rounded z-10" title="Удалить изображение">
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
                                        <img src="{{ $media->getUrl() }}" class="object-cover w-full h-48 rounded" alt="">
                                    </div>
                                @endforeach
                            </div>
                            @foreach ($project->getMedia('images') as $media)
                                <form id="delete-media-{{ $media->id }}" action="{{ route('cabinet.project-media.destroy', $media) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach
                        </div>
                    @endif

                    {{-- Документы --}}
                    @if ($project->getMedia('documents')->count())
                        <div class="mt-10">
                            <label class="block text-gray-700 mb-2 font-medium">Документы:</label>
                            <ul class="space-y-2">
                                @foreach ($project->getMedia('documents') as $media)
                                    <li class="relative flex items-center justify-between bg-gray-50 px-4 py-2 rounded" x-data="{ confirm: false }">
                                        <a href="{{ $media->getUrl() }}" target="_blank" class="text-blue-600 hover:underline">
                                            {{ $media->name ?? basename($media->getPath()) }}
                                        </a>

                                        <button
                                            type="button"
                                            @click="confirm = true"
                                            class="text-red-600 text-sm ml-4"
                                            title="Удалить документ"
                                        >
                                            Удалить
                                        </button>

                                        <div x-show="confirm" class="absolute inset-0 bg-white/90 flex items-center justify-center z-10" x-transition>
                                            <div class="bg-white border border-gray-300 p-4 rounded shadow text-center space-y-4 w-full max-w-xs">
                                                <p class="text-gray-700">Удалить документ?</p>
                                                <div class="flex justify-center gap-2">
                                                    <button @click="document.getElementById('delete-media-{{ $media->id }}').submit()" class="bg-red-600 text-white px-3 py-1 rounded text-sm">Да</button>
                                                    <button @click="confirm = false" class="bg-gray-300 px-3 py-1 rounded text-sm">Нет</button>
                                                </div>
                                            </div>
                                        </div>

                                        <form id="delete-media-{{ $media->id }}" action="{{ route('cabinet.project-media.destroy', $media) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {{-- Видео --}}
                    @if($project->getMedia('videos')->count())
                        <div class="mb-4 mt-10">
                            <span class="font-medium">Видео:</span>

                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-3">
                                @foreach($project->getMedia('videos') as $media)
                                    <div class="border rounded overflow-hidden relative" x-data="{ open: false, confirm: false }" @keydown.window.escape="open = false">
                                        {{-- Кнопка удаления --}}
                                        <button
                                            type="button"
                                            @click="confirm = true"
                                            class="absolute top-1 right-1 bg-red-600 text-white px-2 py-1 text-xs rounded z-10"
                                            title="Удалить видео">
                                            ✕
                                        </button>

                                        {{-- Подтверждение --}}
                                        <div x-show="confirm" class="absolute inset-0 bg-white/80 flex items-center justify-center z-20" x-transition>
                                            <div class="bg-white p-4 rounded shadow text-center space-y-4">
                                                <p>Удалить видео?</p>
                                                <div class="flex justify-center gap-2">
                                                    <button @click="document.getElementById('delete-media-{{ $media->id }}').submit()" class="bg-red-600 text-white px-3 py-1 rounded">Да</button>
                                                    <button @click="confirm = false" class="bg-gray-300 px-3 py-1 rounded">Нет</button>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Превью и модалка --}}
                                        <div @click="open = true" class="w-full h-48 bg-black flex items-center justify-center text-white">
                                            ▶
                                        </div>

                                        <template x-if="open">
                                            <div
                                                x-show="open"
                                                x-transition
                                                @click.self="open = false"
                                                class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
                                            >
                                                <div class="relative max-w-3xl w-full px-4 rounded-xl">
                                                    <button @click="open = false" class="absolute top-0 right-0 m-2 text-white text-2xl font-bold">&times;</button>
                                                    <video controls class="w-full rounded shadow-lg max-h-[90vh]">
                                                        <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
                                                        Ваш браузер не поддерживает видео.
                                                    </video>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Все формы удаления --}}
                            @foreach($project->getMedia('videos') as $media)
                                <form id="delete-media-{{ $media->id }}" action="{{ route('cabinet.project-media.destroy', $media) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endforeach
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</x-cabinet-layout>

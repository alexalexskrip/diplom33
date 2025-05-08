<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Редактирование проекта</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('cabinet.projects.update', $project) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name_project" class="block text-gray-700">Название <span class="text-red-500">*</span></label>
                        <input type="text" id="name_project" name="name_project" class="mt-1 block w-full" value="{{ old('name_project', $project->name_project) }}" required>
                        @error('name_project')
                        <div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="discription_project" class="block text-gray-700">Описание <span class="text-red-500">*</span></label>
                        <textarea id="discription_project" name="discription_project" class="mt-1 block w-full" required>{{ old('discription_project', $project->discription_project) }}</textarea>
                        @error('discription_project')
                        <div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="id_status" class="block text-gray-700">Статус <span class="text-red-500">*</span></label>
                        <select id="id_status" name="id_status" class="mt-1 block w-full">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" @selected(old('id_status', $project->id_status) == $status->id)>{{ $status->namesource_net }}</option>
                            @endforeach
                        </select>
                        @error('id_status')
                        <div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="media_files" class="block text-gray-700">Добавить изображения</label>
                        <input type="file" id="media_files" name="media_files[]" multiple>
                        @error('media_files.*')
                        <div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                    </div>

                    <x-primary-button>Сохранить</x-primary-button>
                </form>

                @if ($project->medias->count())
                    <div class="mt-10">
                        <label class="block text-gray-700 mb-2">Текущие изображения</label>
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

                                    <img src="{{ asset('storage/projectmedia/' . $media->File_ProjectMedia) }}" class="object-cover w-full h-48 rounded">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @foreach ($project->medias as $media)
                        <form id="delete-media-{{ $media->id }}" action="{{ route('cabinet.project-media.destroy', $media) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach
                @endif

                <div class="mt-6">
                    <a href="{{ route('cabinet.projects.index') }}" class="text-blue-500 hover:underline">← Назад к списку</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

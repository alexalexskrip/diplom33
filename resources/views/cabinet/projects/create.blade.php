<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Создание проекта</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('cabinet.projects.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name_project" class="block text-gray-700">Название</label>
                        <input type="text" id="name_project" name="name_project" class="mt-1 block w-full" value="{{ old('name_project') }}">
                        @error('name_project')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="discription_project" class="block text-gray-700">Описание</label>
                        <textarea id="discription_project" name="discription_project" class="mt-1 block w-full">{{ old('discription_project') }}</textarea>
                        @error('discription_project')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="id_status" class="block text-gray-700">Статус</label>
                        <select id="id_status" name="id_status" class="mt-1 block w-full">
                            <option value="">-- Выберите статус --</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" @selected(old('id_status') == $status->id)>{{ $status->namesource_net }}</option>
                            @endforeach
                        </select>
                        @error('id_status')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="media_files" class="block text-gray-700">Изображения</label>
                        <input type="file" id="media_files" name="media_files[]" multiple>
                        @error('media_files.*')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                    </div>

                    <x-primary-button>Создать</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Редактировать проект</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('projects.update', $project->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="name_project" class="block text-sm font-medium text-gray-700">Название</label>
                            <input type="text" name="name_project" id="name_project" value="{{ old('name_project', $project->name_project) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('name_project') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-6">
                            <label for="id_status" class="block text-sm font-medium text-gray-700">Статус</label>
                            <select name="id_status" id="id_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @foreach($statuses as $status)
                                    <option value="{{ $status->id }}" {{ old('id_status', $project->id_status) == $status->id ? 'selected' : '' }}>{{ $status->namesource_net }}</option>
                                @endforeach
                            </select>
                            @error('id_status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-6">
                            <label for="discription_project" class="block text-sm font-medium text-gray-700">Описание</label>
                            <textarea name="discription_project" id="discription_project" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('discription_project', $project->discription_project) }}</textarea>
                            @error('discription_project') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Обновить</button>
                            <a href="{{ route('projects.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

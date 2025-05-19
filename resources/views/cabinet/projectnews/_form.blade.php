<form method="POST" action="{{ $action }}">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-4">
        <label for="project_id" class="block text-gray-700">Проект</label>
        <select id="project_id" name="project_id" class="mt-1 block w-full">
            <option value="">-- Выберите проект --</option>
            @foreach ($projects as $project)

                <option value="{{ $project->id }}" @selected(old('project_id', $news->project_id) == $project->id)>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
        @error('project_id')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
    </div>

    <div class="mb-4">
        <label for="created_at" class="block text-gray-700">Дата</label>
        <input type="date" id="created_at" name="created_at" class="mt-1 block w-full" value="{{ old('created_at', optional($news->created_at)->format('Y-m-d')) }}">
        @error('created_at')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
    </div>

    <div class="mb-4">
        <label for="name" class="block text-gray-700">Название</label>
        <input type="text" id="name" name="name" class="mt-1 block w-full" value="{{ old('name', $news->name) }}">
        @error('name')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700">Описание</label>
        <textarea id="description" name="description" class="mt-1 block w-full">{{ old('description', $news->description) }}</textarea>
        @error('description')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
    </div>

    <div class="flex space-x-4 items-center mt-10">
        <x-primary-button>{{ $method === 'POST' ? 'Создать' : 'Обновить' }}</x-primary-button>
        <a href="{{ route('cabinet.projectnews.index') }}" class="ml-4 text-blue-500 hover:underline">← Назад к списку</a>
    </div>

</form>

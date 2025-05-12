<form method="POST" action="{{ $action }}">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-4">
        <label for="id_project" class="block text-gray-700">Проект</label>
        <select id="id_project" name="id_project" class="mt-1 block w-full">
            <option value="">-- Выберите проект --</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" @selected(old('id_project', $news->id_project) == $project->id)>
                    {{ $project->name_project }}
                </option>
            @endforeach
        </select>
        @error('id_project')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
    </div>

    <div class="mb-4">
        <label for="date_projectnews" class="block text-gray-700">Дата</label>
        <input type="date" id="date_projectnews" name="date_projectnews" class="mt-1 block w-full" value="{{ old('date_projectnews', optional($news->date_projectnews)->format('Y-m-d')) }}">
        @error('date_projectnews')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
    </div>

    <div class="mb-4">
        <label for="name_projectnews" class="block text-gray-700">Название</label>
        <input type="text" id="name_projectnews" name="name_projectnews" class="mt-1 block w-full" value="{{ old('name_projectnews', $news->name_projectnews) }}">
        @error('name_projectnews')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
    </div>

    <div class="mb-4">
        <label for="discription_projectnews" class="block text-gray-700">Описание</label>
        <textarea id="discription_projectnews" name="discription_projectnews" class="mt-1 block w-full">{{ old('discription_projectnews', $news->discription_projectnews) }}</textarea>
        @error('discription_projectnews')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
    </div>

    <div class="flex space-x-4 items-center mt-10">
        <x-primary-button>{{ $method === 'POST' ? 'Создать' : 'Обновить' }}</x-primary-button>
        <a href="{{ route('cabinet.projectnews.index') }}" class="ml-4 text-blue-500 hover:underline">← Назад к списку</a>
    </div>

</form>

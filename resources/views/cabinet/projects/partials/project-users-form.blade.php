@can('manageUsers', $project ?? null)
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-4">Участники проекта</h2>

        @if(isset($project))
            <table class="min-w-full bg-white border border-gray-200 rounded-lg mb-4">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b">ФИО</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($project->users as $user)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $user->lastname }} {{ $user->firstname }} {{ $user->patronymic }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b">
                                <form method="POST" action="{{ route('cabinet.projects.users.remove', [$project, $user]) }}" onsubmit="return confirm('Удалить пользователя из проекта?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center py-4">Нет участников проекта.</td></tr>
                    @endforelse
                </tbody>
            </table>
        @endif

        <form action="{{ isset($project) ? route('cabinet.projects.users.add', $project) : '#' }}" method="POST" class="flex gap-4 items-center">
            @csrf
            <div class="w-full">
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Добавить участника</label>
                <select name="user_id" id="user_id" class="form-select w-full">
                    @foreach($allUsers as $user)
                        @if(!isset($project) || !$project->users->contains($user))
                            <option value="{{ $user->id }}">{{ $user->lastname }} {{ $user->firstname }} {{ $user->patronymic }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            @if(isset($project))
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Добавить</button>
            @else
                <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded" disabled title="Сначала создайте проект">Добавить</button>
            @endif
        </form>
    </div>
@endcan

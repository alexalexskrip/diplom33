<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Добавить сеть</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('cabinet.networklists.store') }}" method="POST">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-y-6 gap-x-4">
                            <div>
                                <label for="name_networklist" class="block text-sm font-medium text-gray-700">Название</label>
                                <input type="text" name="name_networkList" id="name_networkList" value="{{ old('name_networkList') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('name_networklist') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="site_netWWorklist" class="block text-sm font-medium text-gray-700">Сайт</label>
                                <input type="url" name="site_netWWorklist" id="site_netWWorklist" value="{{ old('site_netWWorklist') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('site_netWWorklist') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-start space-x-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Сохранить</button>
                            <a href="{{ route('cabinet.networklists.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

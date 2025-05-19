<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Университеты') }}
        </h2>
    </x-slot>

    <section class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold mb-6">Создание университета</h3>

                    <div class="container mx-auto">
                        <form action="{{ route('cabinet.universities.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-3">
                                <div>
                                    <label for="name" class="block text-sm/6 font-semibold text-gray-900">Название <span class="text-red-500 font-semibold">*</span></label>
                                    <div class="mt-2.5">
                                        <input type="text" name="name_university" id="name" value="{{ old('name_university') }}"
                                               class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-600 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600"
                                               required>

                                        @error('name_university')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="address" class="block text-sm/6 font-semibold text-gray-900">Адрес <span class="text-red-500 font-semibold">*</span></label>
                                    <div class="mt-2.5">
                                        <input type="text" name="address_university" id="address" value="{{ old('address_university') }}"
                                               class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-600 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600"
                                               required>

                                        @error('address_university')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm/6 font-semibold text-gray-900">Телефон <span class="text-red-500 font-semibold">*</span></label>
                                    <div class="mt-2.5">
                                        <input type="text" name="phone_university" id="phone" value="{{ old('phone_university') }}"
                                               class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-600 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600"
                                               required>

                                        @error('phone_university')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm/6 font-semibold text-gray-900">Email <span class="text-red-500 font-semibold">*</span></label>
                                    <div class="mt-2.5">
                                        <input type="email" name="mail_university" id="email" value="{{ old('mail_university') }}"
                                               class="block w-full rounded-md bg-white px-3.5 py-2 text-base text-gray-600 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600"
                                               required>

                                        @error('mail_university')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4 mt-10">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Сохранить
                                </button>
                                <a href="{{ route('cabinet.universities.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Отмена
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-cabinet-layout>

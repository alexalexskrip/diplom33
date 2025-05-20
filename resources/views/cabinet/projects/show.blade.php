<x-cabinet-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Просмотр проекта</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-medium mb-6">{{ $project->name }}</h1>

                    <p class="mb-2"><span class="font-medium">Статус:</span> {{ $project->status->name ?? '—' }}</p>
                    <p class="mb-4"><span class="font-medium">Описание:</span><br>{{ $project->description }}</p>
                    <p class="mb-4"><span class="font-medium">Студенты:</span></p>

                    @if($project->users->isEmpty())
                        <p class="mb-4">Студенты не привязаны</p>
                    @else
                        @foreach($project->users as $user)
                            <p class="mb-4">{{ $user->fullname }}</p>
                        @endforeach
                    @endif

                    <div class="mb-4">
                        <span class="font-medium">Использованные источники:</span>
                        @if($project->sources->isEmpty())
                            <p class="text-gray-500">Нет источников</p>
                        @else
                            <ul class="list-disc list-inside space-y-1 mt-3">
                                @foreach ($project->sources as $source)
                                    <li class="flex items-center justify-between px-4 py-2 @if($loop->odd) bg-gray-100 @endif">
                                        <span>{{ $source->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    @if($project->getMedia('images')->count())
                        <div class="mb-4">
                            <span class="font-medium">Изображения:</span>

                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-3">
                                @foreach($project->getMedia('images') as $media)
                                    <div class="border rounded overflow-hidden cursor-pointer" x-data="{ open: false }" @keydown.window.escape="open = false">
                                        <img @click="open = true" src="{{ $media->getUrl() }}" alt="" class="object-cover w-full h-48">
                                        <div class="text-sm text-center py-1 bg-gray-100">#{{ $media->getCustomProperty('position') + 1 ?? '' }}</div>

                                        <template x-if="open">
                                            <div
                                                x-show="open"
                                                x-transition
                                                @click.self="open = false"
                                                class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
                                            >
                                                <div class="relative">
                                                    <button @click="open = false" class="absolute top-0 right-0 m-2 text-white text-2xl font-bold">&times;</button>
                                                    <img src="{{ $media->getUrl() }}" alt="" class="max-w-3xl max-h-[90vh] shadow-lg rounded">
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($project->getMedia('documents')->count())
                        <div class="mb-4 mt-6">
                            <span class="font-medium">Документы:</span>

                            <ul class="mt-3 space-y-2 list-decimal list-inside text-blue-600">
                                @foreach($project->getMedia('documents') as $doc)
                                    <li>
                                        <a href="{{ $doc->getUrl() }}" target="_blank" class="hover:underline">
                                            {{ $doc->name ?? basename($doc->getPath()) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($project->getMedia('videos')->count())
                        <div class="mb-4">
                            <span class="font-medium">Видео:</span>

                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-3">
                                @foreach($project->getMedia('videos') as $media)
                                    <div class="border rounded overflow-hidden cursor-pointer" x-data="{ open: false }" @keydown.window.escape="open = false">
                                        {{-- Превью иконка или заглушка --}}
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
                        </div>
                    @endif


                    <div class="mt-10 flex items-center space-x-4">
                        <x-primary-button type="button" href="{{ route('cabinet.projects.edit', $project->id) }}">Редактировать</x-primary-button>
                        <a href="{{ route('cabinet.projects.index') }}" class="text-blue-500 hover:underline">← Назад к списку</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-cabinet-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Просмотр проекта</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-6">{{ $project->name_project }}</h1>

                    <p class="mb-2"><strong>Статус:</strong> {{ $project->status->namesource_net ?? '—' }}</p>
                    <p class="mb-4"><strong>Описание:</strong><br>{{ $project->discription_project }}</p>

                    @if($project->medias->count())
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($project->medias as $media)
                                <div class="border rounded overflow-hidden cursor-pointer" x-data="{ open: false }" @keydown.window.escape="open = false">
                                    <img @click="open = true" src="{{ asset('storage/projectmedia/' . $media->File_ProjectMedia) }}" alt="" class="object-cover w-full h-48">
                                    <div class="text-sm text-center py-1 bg-gray-100">#{{ $media->NumFile_ProjectMedia }}</div>

                                    <template x-if="open">
                                        <div
                                            x-show="open"
                                            x-transition
                                            @click.self="open = false"
                                            class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
                                        >
                                            <div class="relative">
                                                <button @click="open = false" class="absolute top-0 right-0 m-2 text-white text-2xl font-bold">&times;</button>
                                                <img src="{{ asset('storage/projectmedia/' . $media->File_ProjectMedia) }}" alt="" class="max-w-3xl max-h-[90vh] shadow-lg rounded">
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Изображения не загружены.</p>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('cabinet.projects.index') }}" class="text-blue-500 hover:underline">← Назад к списку</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Source;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $projects = Project::with(['status', 'media', 'sources'])->paginate(10);
        } else {
            $projects = $user->projects()->with(['status', 'media', 'sources'])->paginate(10);
        }

        return view('cabinet.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Project::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status_id' => 'required|exists:statuses,id',
            'media.*' => 'nullable|file|max:10240',
            'source_lists' => 'array',
            'source_lists.*' => 'exists:sources,id',
            'new_sources' => 'array',
            'new_sources.*' => 'string|max:255',
        ]);

        $sourceIds = $validated['source_lists'] ?? [];

        if (!empty($validated['new_sources'])) {
            foreach ($validated['new_sources'] as $name) {
                $new = Source::create(['name' => $name]);
                $sourceIds[] = $new->id;
            }
        }

        unset($validated['source_lists'], $validated['new_sources']);

        $project = Project::create($validated);
        $project->users()->attach(Auth::id());
        $project->sources()->sync($sourceIds);

        $this->addMedia($request, $project);

        return redirect()->route('cabinet.projects.index')->with('success', 'Проект создан.');
    }

    public function create()
    {
        $this->authorize('create', Project::class);

        $statuses = Status::all();
        $sources = Source::all();
        return view('cabinet.projects.create', compact('statuses', 'sources'));
    }

    /**
     * @param  Request  $request
     * @param $project
     * @return void
     */
    public function addMedia(Request $request, $project): void
    {
        if ($request->hasFile('media')) {
            // Получаем текущую максимальную позицию
            $position = $project->getMedia('images')->max('custom_properties.position') ?? 0;

            foreach ($request->file('media') as $file) {
                $mime = $file->getMimeType();

                if (str_starts_with($mime, 'image/')) {
                    $collection = 'images';

                    $project->addMedia($file)
                        ->withCustomProperties(['position' => ++$position])
                        ->toMediaCollection($collection);

                } elseif (in_array($mime, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain', 'application/pdf'])) {
                    $collection = 'documents';

                    $project->addMedia($file)->toMediaCollection($collection);

                } elseif (str_starts_with($mime, 'video/')) {
                    $collection = 'videos';

                    $project->addMedia($file)->toMediaCollection($collection);

                } else {
                    $project->addMedia($file)->toMediaCollection('default');
                }
            }
        }
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $project->load('status', 'sources', 'users');

        return view('cabinet.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $statuses = Status::all();
        $sources = Source::all();
        $allUsers = User::all();

        return view('cabinet.projects.edit', compact('project', 'statuses', 'sources', 'allUsers'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status_id' => 'required|exists:statuses,id',
            'media.*' => 'nullable|file|max:10240',
            'source_lists' => 'array',
            'source_lists.*' => 'exists:sources,id',
            'new_source' => 'nullable|string|max:255',
        ]);

        if (!empty($validated['new_source'])) {
            $newSource = Source::create(['name' => $validated['new_source']]);
            $validated['source_lists'][] = $newSource->id;
        }

        $project->update($validated);
        $project->sources()->sync($validated['source_lists'] ?? []);

        $this->addMedia($request, $project);

        return redirect()->route('cabinet.projects.index')->with('success', 'Проект обновлён.');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->sources()->detach();
        $project->users()->detach();
        $project->delete();

        return redirect()->route('cabinet.projects.index')->with('success', 'Проект удалён.');
    }

    public function addUser(Request $request, Project $project)
    {
        $this->authorize('manageUsers', $project);

        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $project->users()->syncWithoutDetaching([$request->user_id]);

        return redirect()->back()->with('success', 'Пользователь добавлен в проект.');
    }

    public function removeUser(Project $project, User $user)
    {
        $this->authorize('manageUsers', $project);

        $project->users()->detach($user->id);

        return redirect()->back()->with('success', 'Пользователь удалён из проекта.');
    }
}

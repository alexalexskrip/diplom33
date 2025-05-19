<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Source;
use App\Models\Status;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Str;

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
            'media_files.*' => 'nullable|image|max:5120',
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

        if ($request->hasFile('media_files')) {
            $this->handleMediaUpload($request, $project);
        }

        return redirect()->route('cabinet.projects.index')->with('success', 'Проект создан.');
    }

    public function create()
    {
        $this->authorize('create', Project::class);

        $statuses = Status::all();
        $sources = Source::all();
        return view('cabinet.projects.create', compact('statuses', 'sources'));
    }

    protected function handleMediaUpload(Request $request, Project $project)
    {
        $currentPos = $project->media()->max('position') ?? 0;

        foreach ($request->file('media_files') as $file) {
            $filename = uniqid('project_').Str::uuid().'.'.$file->getClientOriginalExtension();
            $file->storeAs('projectmedia', $filename, 'public');

            $currentPos++;

            $project->media()->create([
                'file_path' => $filename,
                'position' => $currentPos,
            ]);
        }
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $project->load('media', 'status', 'sources', 'users');

        return view('cabinet.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $statuses = Status::all();
        $sources = Source::all();
        return view('cabinet.projects.edit', compact('project', 'statuses', 'sources'));
    }

    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status_id' => 'required|exists:statuses,id',
            'media_files.*' => 'nullable|image|max:5120',
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

        if ($request->hasFile('media_files')) {
            $this->handleMediaUpload($request, $project);
        }

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
}

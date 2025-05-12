<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\SourceList;
use App\Models\StatusList;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $projects = Project::with(['status', 'medias', 'sourceLists'])->paginate(10);
        } else {
            $projects = $user->projects()->with(['status', 'medias', 'sourceLists'])->paginate(10);
        }

        return view('cabinet.projects.index', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);

        $validated = $request->validate([
            'name_project' => 'required|string|max:255',
            'discription_project' => 'required|string',
            'id_status' => 'required|exists:status_lists,id',
            'media_files.*' => 'nullable|image|max:5120',
            'source_lists' => 'array',
            'source_lists.*' => 'exists:source_lists,id',
            'new_sources' => 'array',
            'new_sources.*' => 'string|max:255',
        ]);

        $sourceIds = $validated['source_lists'] ?? [];

        // Добавляем новые источники
        if (!empty($validated['new_sources'])) {
            foreach ($validated['new_sources'] as $name) {
                $new = SourceList::create(['name_sourcelist' => $name]);
                $sourceIds[] = $new->id;
            }
        }

        // Убираем не относящиеся к проекту поля
        unset($validated['source_lists'], $validated['new_sources']);

        $project = Project::create($validated);
        $project->users()->attach(Auth::id());
        $project->sourceLists()->sync($sourceIds);

        if ($request->hasFile('media_files')) {
            $this->handleMediaUpload($request, $project);
        }

        return redirect()->route('cabinet.projects.index')->with('success', 'Проект создан.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        $statuses = StatusList::all();
        $sourceLists = SourceList::all();
        return view('cabinet.projects.create', compact('statuses', 'sourceLists'));
    }

    /**
     * @param  Request  $request
     * @param  Project  $project
     * @return void
     */
    protected function handleMediaUpload(Request $request, Project $project)
    {
        $currentNum = $project->medias()->max('NumFile_ProjectMedia') ?? 0;

        foreach ($request->file('media_files') as $file) {
            $filename = uniqid('project_').Str::uuid().'.'.$file->getClientOriginalExtension();
            $file->storeAs('projectmedia', $filename, 'public');

            $currentNum++;

            $project->medias()->create([
                'File_ProjectMedia' => $filename,
                'NumFile_ProjectMedia' => $currentNum,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $project->load('medias', 'status', 'sourceLists', 'users');
        return view('cabinet.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $statuses = StatusList::all();
        $sourceLists = SourceList::all();
        return view('cabinet.projects.edit', compact('project', 'statuses', 'sourceLists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Project  $project
     * @return RedirectResponse
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name_project' => 'required|string|max:255',
            'discription_project' => 'required|string',
            'id_status' => 'required|exists:status_lists,id',
            'media_files.*' => 'nullable|image|max:5120',
            'source_lists' => 'array',
            'source_lists.*' => 'exists:source_lists,id',
            'new_source' => 'nullable|string|max:255',
        ]);

        if (!empty($validated['new_source'])) {
            $newSource = SourceList::query()->create(['name_sourcelist' => $validated['new_source']]);
            $validated['source_lists'][] = $newSource->id;
        }

        $project->update($validated);
        $project->sourceLists()->sync($validated['source_lists'] ?? []);

        if ($request->hasFile('media_files')) {
            $this->handleMediaUpload($request, $project);
        }

        return redirect()->route('cabinet.projects.index')->with('success', 'Проект обновлён.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return RedirectResponse
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->sourceLists()->detach();
        $project->users()->detach();
        $project->delete();
        return redirect()->route('cabinet.projects.index')->with('success', 'Проект удалён.');
    }
}
